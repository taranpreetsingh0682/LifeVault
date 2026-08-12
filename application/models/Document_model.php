<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Total documents of logged-in user
    public function get_total_documents($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->count_all_results('documents');
    }

    // Total storage used by logged-in user
    public function get_storage_used($user_id)
    {
        $this->db->select('COALESCE(SUM(file_size), 0) AS total_size');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get('documents');

        return $query->row()->total_size;
    }

    // Recent documents
    public function get_recent_documents($user_id, $limit = 5)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->order_by('uploaded_at', 'DESC')
            ->limit($limit)
            ->get('documents')
            ->result();
    }

    // Category counts
    public function get_category_counts($user_id)
    {
        $this->db->select('category, COUNT(*) AS total');
        $this->db->where('user_id', $user_id);
        $this->db->group_by('category');
        $this->db->order_by('total', 'DESC');

        return $this->db
            ->get('documents')
            ->result();
    }


    public function get_important_documents($user_id)
{
    return $this->db
        ->where('user_id', $user_id)
        ->where('is_important', 1)
        ->count_all_results('documents');
}

public function get_shared_documents($user_id)
{
    return $this->db
        ->where('user_id', $user_id)
        ->where('is_shared', 1)
        ->count_all_results('documents');
}
}