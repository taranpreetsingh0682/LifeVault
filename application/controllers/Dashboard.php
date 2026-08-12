<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
  }

  public function dashboard() {
    // Auth guard: redirect to login if not logged in
    if (!$this->session->userdata('loggend_in')) {
      redirect('Auth/login');
      return;
    }

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('dashboard/dashboard');
    $this->load->view('templates/footer');
  }
}
?>