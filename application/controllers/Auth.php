<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Auth extends CI_Controller{
 
// public function__construct()
// {
//   parent::  construct();
//   $this->load->model('User_model');
// }
public function login(){
  $this->load->view('Auth/login');
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
public function registerUser(){
// registration logic


{
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
}
?>