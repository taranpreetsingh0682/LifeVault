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
        $data['category_counts'] = $this->Document_model->get_category_counts($user_id);

        // Get only this user's starred documents.
        $data['documents'] = $this->Document_model->get_important_list(
            $user_id,
            $category
        );

        // Main starred-file count.
        $data['starred_files'] = $this->Document_model->get_important_documents(
            $user_id
        );

        // Identity card: count only STARRED Identity documents.
        $data['identity_docs'] = $this->Document_model->get_important_category_total(
            $user_id,
            'identity'
        );

        // Category filter counts.
        $important_categories = array(
            'identity',
            'education',
            'personal',
            'financial'
        );

        $data['important_category_counts'] = array();

        foreach ($important_categories as $important_category) {
            $data['important_category_counts'][$important_category] =
                $this->Document_model->get_important_category_total(
                    $user_id,
                    $important_category
                );
        }

        // Find the document that was starred most recently.
        $data['last_starred'] =
            $this->Document_model->get_last_important_document($user_id);

        // Encryption status.
        $total_documents =
            $this->Document_model->get_total_documents($user_id);

        $data['encrypted_percent'] =
            $total_documents > 0 ? 100 : 0;

        // Dynamic stats.
        $data['starred_total'] =
            $this->Document_model->get_important_count($user_id);

        $data['identity_count'] =
            $this->Document_model->get_identity_important_count($user_id);

        $data['last_starred_at'] =
            $this->Document_model->get_last_starred_date($user_id);

        // Load views.
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