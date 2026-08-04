<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function settings() {
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('settings/settings');
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->settings();
  }
}
?>
