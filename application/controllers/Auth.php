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
}
public function loginUser(){
// Login logic

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