<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
Class Upload extends CI_Controller{
  public function construct(){
    parent:: construct();
    $this->load->view('User_model');
  }
  public function Upload(){
    $this->load->view('templates/header');
   $this->load->view('templates/sidebar');
    $this->load->view('documents/upload');
    $this->load->view('templates/footer');
    }
}
?>