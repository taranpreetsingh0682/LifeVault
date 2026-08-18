<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
  }

  public function settings() {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $data['settings'] = $this->session->userdata('vault_settings') ?: array('document_view' => 'list', 'auto_category' => 1, 'auto_lock' => '15');
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('settings/settings', $data);
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->settings();
  }

  public function save() {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $settings = array('document_view' => $this->input->post('document_view') === 'grid' ? 'grid' : 'list', 'auto_category' => $this->input->post('auto_category') ? 1 : 0, 'auto_lock' => in_array($this->input->post('auto_lock'), array('5','15','30','never'), TRUE) ? $this->input->post('auto_lock') : '15');
    $this->session->set_userdata('vault_settings', $settings); $this->session->set_flashdata('success', 'Settings saved for this session.'); redirect('settings');
  }
}
?>
