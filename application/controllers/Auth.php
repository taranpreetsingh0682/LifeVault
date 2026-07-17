<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Auth extends CI_Controller{
 
public function   construct()
{
  parent::   construct();
  $this->load->model('User_model');
}
public function login(){
  $this->load->view('Auth/login');
  
}

public function register(){
  $this->load->view('Auth/register');
}
public function home(){
  $this->load->view('Auth/Home');
}

public function logout(){
  // Destroy session
}
public function loginUser(){
// Login logic
}

public function registerUser(){
// registration logic
}

}
?>