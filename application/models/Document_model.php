<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Total documents of logged-in user.
    public function get_total_documents($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->count_all_results('documents');
    }

    // Total storage used by logged-in user (bytes).
    public function get_storage_used($user_id)
    {
        $this->db->select('COALESCE(SUM(file_size), 0) AS total_size');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get('documents');
        return $query->row()->total_size;
    }

    // Recent documents.
    public function get_recent_documents($user_id, $limit = 5)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->order_by('uploaded_at', 'DESC')
            ->limit($limit)
            ->get('documents')
            ->result();
    }

    // Category counts.
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

    // Number of important/starred documents.
    public function get_important_documents($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('is_important', 1)
            ->count_all_results('documents');
    }

    // Number of shared documents.
    public function get_shared_documents($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('is_shared', 1)
            ->count_all_results('documents');
    }

    // Get documents for the current user.
    // Optional category and search text can be applied.
    public function get_documents($user_id, $category = null, $search = null)
    {
        $this->db->where('user_id', $user_id);

        if (!empty($category) && $category !== 'All') {
            $this->db->where('category', $category);
        }

        // Search by document title or original file name.
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('title', $search);
            $this->db->or_like('file_name', $search);
            $this->db->group_end();
        }

        $this->db->order_by('uploaded_at', 'DESC');
        return $this->db->get('documents')->result();
    }

    public function get_document($id, $user_id)
    {
        return $this->db
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->get('documents')
            ->row();
    }

    public function insert_document($data)
    {
        return $this->db->insert('documents', $data);
    }

    public function set_important($id, $user_id, $important)
    {
        return $this->db
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->update('documents', array('is_important' => $important ? 1 : 0));
    }

    public function delete_document($id, $user_id)
    {
        return $this->db
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->delete('documents');
    }

    public function get_important_list($user_id, $category = null)
    {
        $this->db->where('user_id', $user_id)->where('is_important', 1);

        if ($category) {
            $this->db->where('category', $category);
        }

        return $this->db
            ->order_by('uploaded_at', 'DESC')
            ->get('documents')
            ->result();
    }

    public function get_category_total($user_id, $category)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('category', $category)
            ->count_all_results('documents');
    }

    // Number of starred documents in a particular category.
    public function get_important_category_total($user_id, $category)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('is_important', 1)
            ->where('category', $category)
            ->count_all_results('documents');
    }

    // Last starred document.
    // The current database does not have a separate starred_at column,
    // so uploaded_at is used as the closest available timestamp.
    public function get_last_important_document($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('is_important', 1)
            ->order_by('uploaded_at', 'DESC')
            ->limit(1)
            ->get('documents')
            ->row();
    }

    // Recent uploads are used by the notification bell.
    // This keeps notifications real without introducing a second table.
    public function get_recent_notifications($user_id, $limit = 5)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->order_by('uploaded_at', 'DESC')
            ->limit($limit)
            ->get('documents')
            ->result();
    }

    // Number of uploads made during the last 24 hours.
    public function get_recent_notification_count($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('uploaded_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')));
        return $this->db->count_all_results('documents');
    }
}
?>