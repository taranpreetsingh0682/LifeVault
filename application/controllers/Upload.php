<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Document_model');
  }

  public function upload() {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $data['recent_documents'] = $this->Document_model->get_recent_documents($this->session->userdata('user_id'), 10);
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('documents/upload', $data);
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->upload();
  }

  public function store() {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $title = trim($this->input->post('title'));
    $category = strtolower(trim($this->input->post('category')));
    $allowed_categories = array('identity', 'personal', 'education', 'certificates', 'images', 'records');
    if (!$title || !in_array($category, $allowed_categories, TRUE) || empty($_FILES['document']['name'])) {
      $this->session->set_flashdata('error', 'Choose a file, title, and valid category.'); redirect('upload'); return;
    }
    $upload_path = FCPATH . 'uploads/' . $this->session->userdata('user_id') . '/';
    if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
      $this->session->set_flashdata('error', 'Unable to prepare secure upload storage.'); redirect('upload'); return;
    }
    $this->load->library('upload', array(
      'upload_path' => $upload_path, 'allowed_types' => 'pdf|jpg|jpeg|png|doc|docx|xls|xlsx',
      'max_size' => 25600, 'encrypt_name' => TRUE
    ));
    if (!$this->upload->do_upload('document')) {
      $this->session->set_flashdata('error', strip_tags($this->upload->display_errors('', ''))); redirect('upload'); return;
    }
    $file = $this->upload->data();
    $this->Document_model->insert_document(array(
      'user_id' => $this->session->userdata('user_id'), 'title' => $title, 'category' => $category,
      'file_name' => $file['client_name'], 'file_path' => 'uploads/' . $this->session->userdata('user_id') . '/' . $file['file_name'],
      'file_size' => $file['file_size'] * 1024, 'file_type' => $file['file_ext'], 'is_important' => 0, 'is_shared' => 0
    ));
    $this->session->set_flashdata('success', 'Document uploaded successfully.'); redirect('documents');
  }
}
?>
