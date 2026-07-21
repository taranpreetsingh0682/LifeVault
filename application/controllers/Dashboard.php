<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Dashboard extends CI_Controller{
  public function  construct()
  {
    parent::  construct();
    $this->load->model('User_model');
  }

  public function dashboard(){
   
    $this->load->view('templates/header');
   
    $this->load->view('dashboard/dashboard');
    $this->load->view('templates/footer');
  }
  
}





?>