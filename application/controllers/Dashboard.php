<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct() {
    parent::__construct();
    // $this->load->model('User_model');
  }

  public function dashboard() {
  $this->load->library('session');

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('dashboard/dashboard');
    $this->load->view('templates/footer');
  }
}
?>