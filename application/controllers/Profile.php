<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Profile extends CI_Controller{
  public function construct(){
    parent:: construct();
      $this->load->view('User_model');
    }
  public function profile(){
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
      $this->load->view('Profile/profile');
    $this->load->view('templates/footer');
  }
  }

?>