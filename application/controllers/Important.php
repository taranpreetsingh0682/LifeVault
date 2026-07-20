<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
Class Important extends CI_Controller{
  public function construct(){
    parent:: construct();
    $this->load->view('User_model');
  }
  public function important(){
      $this->load->view('templates/header');
   $this->load->view('templates/sidebar');
    $this->load->view('Important/important');
    $this->load->view('templates/footer');
  }
}
?>