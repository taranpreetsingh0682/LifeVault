<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function profile() {
    $this->load->library('session');
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('profile/profile');
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->profile();
  }
}
?>