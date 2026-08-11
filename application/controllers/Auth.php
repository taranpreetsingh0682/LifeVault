<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Auth extends CI_Controller{
 
// public function__construct()
// {
//   parent::  construct();
//   $this->load->model('User_model');
// }
 public function login()
{
    $this->load->library('session');
    $this->config->load('google');
    $this->load->model('User_model');
    $this->load->view('Auth/login',$data);

}

public function googleLogin()
{
    $this->load->library('session');
    $this->config->load('google');

    // Generate secure state
    $state = bin2hex(random_bytes(32));

    // Store state in session
    $this->session->set_userdata(
        'google_oauth_state',
        $state
    );

    // Create Google authorization URL
    $google_url =
        'https://accounts.google.com/o/oauth2/v2/auth?' .
        http_build_query([
            'client_id' =>
                $this->config->item('google_client_id'),

            'redirect_uri' =>
                $this->config->item('google_redirect_uri'),

            'response_type' => 'code',

            'scope' => 'openid email profile',

            'access_type' => 'online',

            'state' => $state
        ]);

    redirect($google_url);
}


public function googleCallback()
{
    $this->load->library('session');
    $this->load->model('User_model');
    $this->config->load('google');

    // Check if Google returned an error
    if ($this->input->get('error')) {

        $this->session->set_flashdata(
            'error',
            'Google login was cancelled or denied.'
        );

        redirect('Auth/login');
        return;
    }

    // Get authorization code
    $code = $this->input->get('code');

    if (empty($code)) {

        $this->session->set_flashdata(
            'error',
            'Google authorization code was not received.'
        );

        redirect('Auth/login');
        return;
    }

    // Check state
    $state = $this->input->get('state');

    $saved_state = $this->session->userdata('google_oauth_state');

    if (empty($state) || empty($saved_state) || !hash_equals($saved_state, $state)) {

        $this->session->set_flashdata(
            'error',
            'Invalid Google login request.'
        );

        redirect('Auth/login');
        return;
    }

    // Remove state after validation
    $this->session->unset_userdata('google_oauth_state');


    /*
    |--------------------------------------------------------------------------
    | Exchange authorization code for access token
    |--------------------------------------------------------------------------
    */

    $token_url = 'https://oauth2.googleapis.com/token';

    $post_data = [
        'code' => $code,
        'client_id' => $this->config->item('google_client_id'),
        'client_secret' => $this->config->item('google_client_secret'),
        'redirect_uri' => $this->config->item('google_redirect_uri'),
        'grant_type' => 'authorization_code'
    ];

    $ch = curl_init($token_url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    $token_response = curl_exec($ch);

    if ($token_response === false) {

        curl_close($ch);

        $this->session->set_flashdata(
            'error',
            'Unable to connect to Google.'
        );

        redirect('Auth/login');
        return;
    }

    curl_close($ch);

    $token_data = json_decode($token_response, true);

    if (empty($token_data['access_token'])) {

        $this->session->set_flashdata(
            'error',
            'Unable to get Google access token.'
        );

        redirect('Auth/login');
        return;
    }

    $access_token = $token_data['access_token'];


    /*
    |--------------------------------------------------------------------------
    | Get Google user information
    |--------------------------------------------------------------------------
    */

    $userinfo_url = 'https://openidconnect.googleapis.com/v1/userinfo';

    $ch = curl_init($userinfo_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $access_token
    ]);

    $userinfo_response = curl_exec($ch);

    if ($userinfo_response === false) {

        curl_close($ch);

        $this->session->set_flashdata(
            'error',
            'Unable to retrieve Google account information.'
        );

        redirect('Auth/login');
        return;
    }

    curl_close($ch);

    $google_user = json_decode($userinfo_response);

    if (empty($google_user->email)) {

        $this->session->set_flashdata(
            'error',
            'Google did not provide an email address.'
        );

        redirect('Auth/login');
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Find user in LifeVault database
    |--------------------------------------------------------------------------
    */

    $user = $this->User_model->getUserByEmail(
        $google_user->email
    );


    /*
    |--------------------------------------------------------------------------
    | Existing LifeVault user
    |--------------------------------------------------------------------------
    */

    if ($user) {

        $session_data = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'loggend_in' => TRUE
        ];

        $this->session->set_userdata($session_data);

        redirect('dashboard/dashboard');
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Google account doesn't exist in LifeVault
    |--------------------------------------------------------------------------
    */

    $this->session->set_flashdata(
        'error',
        'No LifeVault account exists with this Google email. Please register first.'
    );

    redirect('Auth/login');
}


public function forgetPassword(){
  $this->load->view('Auth/forgetPassword');
  $this->load->model('User_model');
  $this->load->library('session');
}

public function register(){
  $this->load->view('Auth/register');
 $this->load->model('User_model');
}
public function home(){
  $this->load->view('Auth/Home');
 $this->load->model('User_model');

}

public function logout(){
  // Destroy session

  $this->session->session_destroy();
  redirect('Auth/login');
}
public function loginUser(){
// Login logic

// Load what this method needs
 $this->load->model('User_model');
 $this->load->library('session');

$email=$this->input->post('email');
$password=$this->input->post('password');

// Find user by  email

$user= $this->User_model->getUserByEmail($email);

if($user){
  // verify password
  if (password_verify($password, $user->password))
    {
      // Create login session
      $session_data=array(
        'user_id'=>$user->id,
        'name'=>$user->name,
        'email'=>$user->email,
        'loggend_in'=>TRUE      
        );

        $this->session->set_userdata($session_data);

        // go to dashboard

        redirect('dashboard/dashboard');
    }
    else{
     $this->session->set_flashdata(
      'error',
      'Invalid password '
     );
     redirect('Auth/login');
    }

}
else{
  $this->session->set_flashdata(
    'error',
    'No account found with this email.'
  );
  redirect('Auth/login');
}

}


public function sendResetLink()
{
    $this->load->model('User_model');
    $this->load->library('session');

    $email = trim($this->input->post('email'));

    if (empty($email)) {
        $this->session->set_flashdata('error', 'Please enter your email address.');
        $this->session->set_flashdata('open_forgot_modal', TRUE);
        redirect('Auth/login');
        return;
    }

    $user = $this->User_model->getUserByEmail($email);

    if (!$user) {
        $this->session->set_flashdata('error', 'No account found with this email.');
        $this->session->set_flashdata('open_forgot_modal', TRUE);
        redirect('Auth/login');
        return;
    }

    $token = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', time() + 3600);

    $data = array(
        'reset_token'   => $token,
        'reset_expires' => $expires
    );

    $this->User_model->saveResetToken($user->id, $data);

    $reset_link = site_url('Auth/resetPassword/' . $token);

    // In production, send $reset_link by email. For now we flash it for testing.
    $this->session->set_flashdata(
        'success',
        'Reset link generated successfully. Use the link below to set a new password.'
    );
    $this->session->set_flashdata('reset_link', $reset_link);

    redirect('Auth/login');
}

public function resetPassword($token = NULL)
{
    $this->load->model('User_model');
    $this->load->library('session');

    if (empty($token)) {
        redirect('Auth/login');
        return;
    }

    $user = $this->User_model->getUserByResetToken($token);

    if (!$user || empty($user->reset_expires) || strtotime($user->reset_expires) < time()) {
        $this->session->set_flashdata(
            'error',
            'This reset link is invalid or has expired. Please request a new one.'
        );
        redirect('Auth/login');
        return;
    }

    $this->load->view('Auth/reset_password', array('token' => $token));
}

public function updatePassword()
{
    $this->load->model('User_model');
    $this->load->library('session');

    $token = $this->input->post('token');
    $password = $this->input->post('password');
    $confirm_password = $this->input->post('confirm_password');

    if (empty($password) || strlen($password) < 6) {
        $this->session->set_flashdata('error', 'Password must be at least 6 characters.');
        redirect('Auth/resetPassword/' . $token);
        return;
    }

    if ($password !== $confirm_password) {
        $this->session->set_flashdata('error', 'Passwords do not match.');
        redirect('Auth/resetPassword/' . $token);
        return;
    }

    $user = $this->User_model->getUserByResetToken($token);

    if (!$user || empty($user->reset_expires) || strtotime($user->reset_expires) < time()) {
        $this->session->set_flashdata(
            'error',
            'This reset link is invalid or has expired. Please request a new one.'
        );
        redirect('Auth/login');
        return;
    }

    $this->User_model->updatePassword(
        $user->id,
        password_hash($password, PASSWORD_DEFAULT)
    );
    $this->User_model->clearResetToken($user->id);

    $this->session->set_flashdata(
        'success',
        'Your password has been updated. You can now login with your new password.'
    );
    redirect('Auth/login');
}

public function registerUser(){
    $data = array(
        'name'         => $this->input->post('name'),
        'email'        => $this->input->post('email'),
        'country'      => $this->input->post('country'),
        'phone_number' => $this->input->post('phone_number'),
        'password'     => password_hash(
            $this->input->post('password'),
            PASSWORD_DEFAULT
        )
    );
    $this->load->model('User_model');
    if ($this->User_model->insertUser($data)) {
        redirect('Auth/login');
    } else {
        echo "Registration failed";
    }
}
}
?>