<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Important extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function important() {
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('Important/important');
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->important();
  }
}
?>