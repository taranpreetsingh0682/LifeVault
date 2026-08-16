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

  // Get documents
  $data['documents'] = $this->Document_model
  ->get_documents($user_id, $category);

  // Send selected category to view
  $data['selected_category']=$category ? $category :'All';
  



    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('documents/documents',$data);
    $this->load->view('templates/footer');
  }

}
?>