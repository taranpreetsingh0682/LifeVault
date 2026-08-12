<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */
    public function login()
    {
        $this->load->library('session');
        $this->config->load('google');
        $this->load->model('User_model');

        $this->load->view('Auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | GOOGLE LOGIN
    |--------------------------------------------------------------------------
    */
    public function googleLogin()
    {
        $this->load->library('session');
        $this->config->load('google');

        $state = bin2hex(random_bytes(32));

        $this->session->set_userdata(
            'google_oauth_state',
            $state
        );

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


    /*
    |--------------------------------------------------------------------------
    | GOOGLE CALLBACK
    |--------------------------------------------------------------------------
    */
    public function googleCallback()
    {
        $this->load->library('session');
        $this->load->model('User_model');
        $this->config->load('google');


        // 1. Google returned an error
        if ($this->input->get('error')) {

            $this->session->set_flashdata(
                'error',
                'Google login was cancelled or denied.'
            );

            redirect('Auth/login');
            return;
        }


        // 2. Get authorization code
        $code = $this->input->get('code');

        if (empty($code)) {

            $this->session->set_flashdata(
                'error',
                'Google authorization code was not received.'
            );

            redirect('Auth/login');
            return;
        }


        // 3. Verify OAuth state
        $state = $this->input->get('state');

        $saved_state =
            $this->session->userdata('google_oauth_state');

        if (
            empty($state) ||
            empty($saved_state) ||
            !hash_equals($saved_state, $state)
        ) {

            $this->session->set_flashdata(
                'error',
                'Invalid Google login request.'
            );

            redirect('Auth/login');
            return;
        }


        // Remove state after validation
        $this->session->unset_userdata(
            'google_oauth_state'
        );


        // 4. Exchange code for access token
        $token_url =
            'https://oauth2.googleapis.com/token';

        $post_data = [
            'code' => $code,

            'client_id' =>
                $this->config->item('google_client_id'),

            'client_secret' =>
                $this->config->item('google_client_secret'),

            'redirect_uri' =>
                $this->config->item('google_redirect_uri'),

            'grant_type' => 'authorization_code'
        ];


        $ch = curl_init($token_url);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            http_build_query($post_data)
        );

        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            true
        );

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/x-www-form-urlencoded'
            ]
        );


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


        $token_data =
            json_decode($token_response, true);


        if (
            empty($token_data['access_token'])
        ) {

            $this->session->set_flashdata(
                'error',
                'Unable to get Google access token.'
            );

            redirect('Auth/login');
            return;
        }


        $access_token =
            $token_data['access_token'];


        // 5. Get Google user information
        $userinfo_url =
            'https://openidconnect.googleapis.com/v1/userinfo';


        $ch = curl_init($userinfo_url);

        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            true
        );

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Authorization: Bearer ' . $access_token
            ]
        );


        $userinfo_response =
            curl_exec($ch);


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


        $google_user =
            json_decode($userinfo_response);


        if (empty($google_user->email)) {

            $this->session->set_flashdata(
                'error',
                'Google did not provide an email address.'
            );

            redirect('Auth/login');
            return;
        }


        // 6. Find user
        $user =
            $this->User_model->getUserByEmail(
                $google_user->email
            );


        // 7. Existing user
        if ($user) {

            $session_data = [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'loggend_in' => TRUE
            ];


            $this->session->set_userdata(
                $session_data
            );


            // Create remember token
            $this->createRememberToken(
                $user->id
            );


            redirect('dashboard/dashboard');
            return;
        }


        // 8. New Google user
        $data = [
            'name' => $google_user->name,

            'email' => $google_user->email,

            'country' => '',

            'phone_number' => '',

            'password' => password_hash(
                bin2hex(random_bytes(32)),
                PASSWORD_DEFAULT
            )
        ];


        $inserted =
            $this->User_model->insertUser($data);


        if (!$inserted) {

            $this->session->set_flashdata(
                'error',
                'Unable to create your LifeVault account.'
            );

            redirect('Auth/login');
            return;
        }


        // 9. Get newly created user
        $user =
            $this->User_model->getUserByEmail(
                $google_user->email
            );


        if (!$user) {

            $this->session->set_flashdata(
                'error',
                'Unable to retrieve newly created account.'
            );

            redirect('Auth/login');
            return;
        }


        // 10. Create session
        $session_data = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'loggend_in' => TRUE
        ];


        $this->session->set_userdata(
            $session_data
        );


        // Create remember token
        $this->createRememberToken(
            $user->id
        );


        // 11. Dashboard
        redirect('dashboard/dashboard');
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | MANUAL LOGIN
    |--------------------------------------------------------------------------
    */
    public function loginUser()
    {
        $this->load->model('User_model');
        $this->load->library('session');


        $email =
            trim($this->input->post('email'));

        $password =
            $this->input->post('password');


        // Find user
        $user =
            $this->User_model->getUserByEmail($email);


        if (!$user) {

            $this->session->set_flashdata(
                'error',
                'No account found with this email.'
            );

            redirect('Auth/login');
            return;
        }


        // Verify password
        if (
            !password_verify(
                $password,
                $user->password
            )
        ) {

            $this->session->set_flashdata(
                'error',
                'Invalid password.'
            );

            redirect('Auth/login');
            return;
        }


        // Create session
        $session_data = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'loggend_in' => TRUE
        ];


        $this->session->set_userdata(
            $session_data
        );


        // Create remember token
        $this->createRememberToken(
            $user->id
        );


        redirect('dashboard/dashboard');
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | TEST EMAIL
    |--------------------------------------------------------------------------
    */
    public function testEmail()
    {
        $this->load->library('email');


        $this->email->from(
            'lifevaultsys@gmail.com',
            'LifeVault'
        );


        $this->email->to(
            'lifevaultsys@gmail.com'
        );


        $this->email->subject(
            'Welcome to LifeVault'
        );


        $message = '
            <h2>Welcome to LifeVault! 🎉</h2>

            <p>
                Your LifeVault email notification system
                is working successfully.
            </p>

            <p>
                You can now securely manage your
                important documents.
            </p>

            <br>

            <p>
                Regards,<br>
                <strong>LifeVault Team</strong>
            </p>
        ';


        $this->email->message($message);


        if ($this->email->send()) {

            echo "Email sent successfully.";

        } else {

            echo $this->email->print_debugger();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | WELCOME EMAIL
    |--------------------------------------------------------------------------
    */
    private function sendWelcomeEmail($email, $name)
    {
        $this->load->library('email');


        $this->email->from(
            'lifevaultsys@gmail.com',
            'LifeVault'
        );


        $this->email->to($email);


        $this->email->subject(
            'Welcome to LifeVault 🎉'
        );


        $safe_name =
            htmlspecialchars(
                $name,
                ENT_QUOTES,
                'UTF-8'
            );


        $message = '
            <div style="
                font-family: Arial, sans-serif;
                padding: 20px;
            ">

                <h2>
                    Welcome to LifeVault,
                    ' . $safe_name . '! 🎉
                </h2>

                <p>
                    Your LifeVault account has been
                    successfully created.
                </p>

                <p>
                    You can now securely store,
                    manage and access your
                    important documents in one place.
                </p>

                <p>
                    Thank you for choosing LifeVault.
                </p>

                <br>

                <p>
                    Regards,<br>
                    <strong>LifeVault Team</strong>
                </p>

            </div>
        ';


        $this->email->message($message);


        return $this->email->send();
    }


    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD PAGE
    |--------------------------------------------------------------------------
    */
    public function forgetPassword()
    {
        $this->load->library('session');
        $this->load->model('User_model');

        $this->load->view(
            'Auth/forgetPassword'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE
    |--------------------------------------------------------------------------
    */
    public function register()
    {
        $this->load->model('User_model');

        $this->load->view(
            'Auth/register'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HOME PAGE
    |--------------------------------------------------------------------------
    */
    public function home()
    {
        $this->load->model('User_model');

        $this->load->view(
            'Auth/Home'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout()
    {
        $this->load->library('session');
        $this->load->model('User_model');


        $user_id =
            $this->session->userdata('user_id');


        // Clear database remember token
        if ($user_id) {

            $this->User_model->clearRememberToken(
                $user_id
            );
        }


        // Delete browser cookie
        delete_cookie(
            'lifevault_remember'
        );


        // Destroy session
        $this->session->sess_destroy();


        redirect('Auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | SEND RESET LINK
    |--------------------------------------------------------------------------
    */
    public function sendResetLink()
    {
        $this->load->model('User_model');
        $this->load->library('session');


        $email =
            trim(
                $this->input->post('email')
            );


        if (empty($email)) {

            $this->session->set_flashdata(
                'error',
                'Please enter your email address.'
            );

            $this->session->set_flashdata(
                'open_forgot_modal',
                TRUE
            );

            redirect('Auth/login');
            return;
        }


        $user =
            $this->User_model->getUserByEmail(
                $email
            );


        if (!$user) {

            $this->session->set_flashdata(
                'error',
                'No account found with this email.'
            );

            $this->session->set_flashdata(
                'open_forgot_modal',
                TRUE
            );

            redirect('Auth/login');
            return;
        }


        $token =
            bin2hex(
                random_bytes(32)
            );


        $expires =
            date(
                'Y-m-d H:i:s',
                time() + 3600
            );


        $data = [
            'reset_token' => $token,
            'reset_expires' => $expires
        ];


        $this->User_model->saveResetToken(
            $user->id,
            $data
        );


        $reset_link =
            site_url(
                'Auth/resetPassword/' . $token
            );


        // Testing for now
        $this->session->set_flashdata(
            'success',
            'Reset link generated successfully. Use the link below to set a new password.'
        );


        $this->session->set_flashdata(
            'reset_link',
            $reset_link
        );


        redirect('Auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD PAGE
    |--------------------------------------------------------------------------
    */
    public function resetPassword($token = NULL)
    {
        $this->load->model('User_model');
        $this->load->library('session');


        if (empty($token)) {

            redirect('Auth/login');
            return;
        }


        $user =
            $this->User_model->getUserByResetToken(
                $token
            );


        if (
            !$user ||
            empty($user->reset_expires) ||
            strtotime($user->reset_expires) < time()
        ) {

            $this->session->set_flashdata(
                'error',
                'This reset link is invalid or has expired. Please request a new one.'
            );

            redirect('Auth/login');
            return;
        }


        $this->load->view(
            'Auth/reset_password',
            [
                'token' => $token
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */
    public function updatePassword()
    {
        $this->load->model('User_model');
        $this->load->library('session');


        $token =
            $this->input->post('token');

        $password =
            $this->input->post('password');

        $confirm_password =
            $this->input->post('confirm_password');


        if (
            empty($password) ||
            strlen($password) < 6
        ) {

            $this->session->set_flashdata(
                'error',
                'Password must be at least 6 characters.'
            );

            redirect(
                'Auth/resetPassword/' . $token
            );

            return;
        }


        if (
            $password !== $confirm_password
        ) {

            $this->session->set_flashdata(
                'error',
                'Passwords do not match.'
            );

            redirect(
                'Auth/resetPassword/' . $token
            );

            return;
        }


        $user =
            $this->User_model->getUserByResetToken(
                $token
            );


        if (
            !$user ||
            empty($user->reset_expires) ||
            strtotime($user->reset_expires) < time()
        ) {

            $this->session->set_flashdata(
                'error',
                'This reset link is invalid or has expired. Please request a new one.'
            );

            redirect('Auth/login');
            return;
        }


        // Update password
        $this->User_model->updatePassword(
            $user->id,
            password_hash(
                $password,
                PASSWORD_DEFAULT
            )
        );


        // Clear reset token
        $this->User_model->clearResetToken(
            $user->id
        );


        $this->session->set_flashdata(
            'success',
            'Your password has been updated. You can now login with your new password.'
        );


        redirect('Auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER USER
    |--------------------------------------------------------------------------
    */
    public function registerUser()
    {
        $data = [
            'name' =>
                $this->input->post('name'),

            'email' =>
                $this->input->post('email'),

            'country' =>
                $this->input->post('country'),

            'phone_number' =>
                $this->input->post('phone_number'),

            'password' =>
                password_hash(
                    $this->input->post('password'),
                    PASSWORD_DEFAULT
                )
        ];


        $this->load->model('User_model');


        if (
            $this->User_model->insertUser($data)
        ) {

            redirect('Auth/login');
            return;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE REMEMBER TOKEN
    |--------------------------------------------------------------------------
    */
    private function createRememberToken($user_id)
    {
        $this->load->model('User_model');


        // Generate random token
        $token =
            bin2hex(
                random_bytes(32)
            );


        // Hash token for database
        $token_hash =
            hash(
                'sha256',
                $token
            );


        // Token valid for 30 days
        $expires =
            date(
                'Y-m-d H:i:s',
                time() + (30 * 24 * 60 * 60)
            );


        // Save hash and expiry
        $this->User_model->saveRememberToken(
            $user_id,
            $token_hash,
            $expires
        );


        // Store raw token in browser cookie
        set_cookie(
            'lifevault_remember',
            $token,
            30 * 24 * 60 * 60
        );
    }
}