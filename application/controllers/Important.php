<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Important extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Document_model');
  }

  public function important() {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $data['documents'] = $this->Document_model->get_important_list($this->session->userdata('user_id'), $this->input->get('category'));
    $data['category_counts'] = $this->Document_model->get_category_counts($this->session->userdata('user_id'));
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('Important/important', $data);
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->important();
  }
}
?>
