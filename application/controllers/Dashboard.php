<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Document_model');
  }

  public function dashboard() {
    // Auth guard: redirect to login if not logged in
    if (!$this->session->userdata('loggend_in')) {
      redirect('Auth/login');
      return;
    }

    // get looged-in users id
    $user_id=$this->session->userdata('user_id');

    // Dashboard statistics
    $data['total_documents']=
    $this->Document_model->get_total_documents($user_id);

    $data['storage_used']=$this->Document_model->get_storage_used($user_id);

    // Recent documents
    $data['recent_documents']=
    $this->Document_model->get_recent_documents($user_id, 5);

    // Categories
    $data['categories']=
    $this->Document_model->get_category_counts($user_id);


    $data['storage_used'] =
    $this->Document_model->get_storage_used($user_id);

$data['important_documents'] =
    $this->Document_model->get_important_documents($user_id);

$data['shared_documents'] =
    $this->Document_model->get_shared_documents($user_id);


    // Laod dashboard 
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('dashboard/dashboard',$data);
    $this->load->view('templates/footer');
  }
}
?>