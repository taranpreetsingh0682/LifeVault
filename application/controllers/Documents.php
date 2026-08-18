<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Document_model');

  }
 
  
  public function index() {
    // login check
    if(!$this->session->userdata('loggend_in')){
      redirect('auth/login');
      return;
    }

    // get logged-in user ID
    $user_id=$this->session->userdata('user_id');

  //  Selected category
  $category=$this->input->get('category');

  // Get documents and page stats
  $data['documents'] = $this->Document_model
  ->get_documents($user_id, $category);
  $data['category_counts'] = $this->Document_model->get_category_counts($user_id);
  $data['storage_used'] = $this->Document_model->get_storage_used($user_id);

  // Send selected category to view
  $data['selected_category']=$category ? $category :'All';
  



    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('documents/documents',$data);
    $this->load->view('templates/footer');
  }

  public function toggleImportant($id) {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $document = $this->Document_model->get_document((int) $id, $this->session->userdata('user_id'));
    if (!$document) { show_404(); return; }
    $this->Document_model->set_important($document->id, $this->session->userdata('user_id'), !$document->is_important);
    $this->session->set_flashdata('success', $document->is_important ? 'Removed from Important.' : 'Added to Important.');
    redirect('documents');
  }

  public function download($id) {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $document = $this->Document_model->get_document((int) $id, $this->session->userdata('user_id'));
    if (!$document || !is_file(FCPATH . $document->file_path)) { show_404(); return; }
    $this->load->helper('download'); force_download($document->file_name, file_get_contents(FCPATH . $document->file_path));
  }

  public function view($id) {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $document = $this->Document_model->get_document((int) $id, $this->session->userdata('user_id'));
    $path = $document ? FCPATH . $document->file_path : '';
    if (!$document || !is_file($path)) { show_404(); return; }
    $mime = function_exists('mime_content_type') ? mime_content_type($path) : 'application/octet-stream';
    $this->output
      ->set_content_type($mime)
      ->set_header('Content-Disposition: inline; filename="' . basename($document->file_name) . '"')
      ->set_output(file_get_contents($path));
  }

  public function delete($id) {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $document = $this->Document_model->get_document((int) $id, $this->session->userdata('user_id'));
    if (!$document) { show_404(); return; }
    $path = FCPATH . $document->file_path;
    if (is_file($path)) unlink($path);
    $this->Document_model->delete_document($document->id, $this->session->userdata('user_id'));
    $this->session->set_flashdata('success', 'Document deleted.'); redirect('documents');
  }

}
?>
