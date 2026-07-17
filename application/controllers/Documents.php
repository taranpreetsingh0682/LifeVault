<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
Class Documents extends CI_Controller{
  public function construct(){
    parent:: construct();
    $this->load->view('User_model');
  }
  public function documents(){
    $this->load->view('templates/header');
   
    $this->load->view('documents/documents');
    $this->load->view('templates/footer');
    }
}



?>