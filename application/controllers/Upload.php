<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
  }

  public function upload() {
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('documents/upload');
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->upload();
  }
}
?>