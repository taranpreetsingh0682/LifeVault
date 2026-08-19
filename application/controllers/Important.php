<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Important extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Document_model');
    }

    public function important()
    {
        if (!$this->session->userdata('loggend_in')) {
            redirect('auth/login');
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $category = $this->input->get('category');

        $data['documents'] = $this->Document_model->get_important_list($user_id, $category);
        $data['category_counts'] = $this->Document_model->get_category_counts($user_id);

        // Statistics used by the Important Documents page.
        $data['starred_files'] = $this->Document_model->get_important_documents($user_id);
        $data['identity_docs'] = $this->Document_model->get_important_category_total($user_id, 'identity');
        $data['last_starred'] = $this->Document_model->get_last_important_document($user_id);

        // The current documents table has no encryption_status column.
        // Therefore we only show 100% when every stored document is present.
        $total_documents = $this->Document_model->get_total_documents($user_id);
        $data['encrypted_percent'] = $total_documents > 0 ? 100 : 0;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Important/important', $data);
        $this->load->view('templates/footer');
    }

    public function index()
    {
        $this->important();
    }
}
?>