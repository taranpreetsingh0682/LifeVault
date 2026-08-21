<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Total documents belonging to the logged-in user.
    public function get_total_documents($user_id)
    {
        return $this->db->where('user_id', $user_id)->count_all_results('documents');
    }

    // Total storage used by the user, returned in bytes.
    public function get_storage_used($user_id)
    {
        $this->db->select('COALESCE(SUM(file_size), 0) AS total_size');
        $this->db->where('user_id', $user_id);
        return $this->db->get('documents')->row()->total_size;
    }

    public function get_recent_documents($user_id, $limit = 5)
    {
        return $this->db->where('user_id', $user_id)
            ->order_by('uploaded_at', 'DESC')
            ->limit($limit)
            ->get('documents')->result();
    }

    // Counts all documents by category.
    public function get_category_counts($user_id)
    {
        $this->db->select('category, COUNT(*) AS total');
        $this->db->where('user_id', $user_id);
        $this->db->group_by('category');
        return $this->db->get('documents')->result();
    }

    // Counts only starred/important documents.
    public function get_important_documents($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->where('is_important', 1)
            ->count_all_results('documents');
    }

    public function get_shared_documents($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->where('is_shared', 1)
            ->count_all_results('documents');
    }

    // Get the user's documents, optionally filtered by category and search text.
    public function get_documents($user_id, $category = null, $search = null)
    {
        $this->db->where('user_id', $user_id);

        if (!empty($category) && $category !== 'All') {
            $this->db->where('category', $category);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('title', $search);
            $this->db->or_like('file_name', $search);
            $this->db->group_end();
        }

        return $this->db->order_by('uploaded_at', 'DESC')
            ->get('documents')->result();
    }

    public function get_document($id, $user_id)
    {
        return $this->db->where('id', $id)
            ->where('user_id', $user_id)
            ->get('documents')->row();
    }

    public function insert_document($data)
    {
        return $this->db->insert('documents', $data);
    }

    // Star or unstar a document.
    // starred_at records the real moment the user starred it.
    public function set_important($id, $user_id, $important)
    {
        $update = array(
            'is_important' => $important ? 1 : 0,
            'starred_at' => $important ? date('Y-m-d H:i:s') : null
        );

        return $this->db->where('id', $id)
            ->where('user_id', $user_id)
            ->update('documents', $update);
    }

    public function delete_document($id, $user_id)
    {
        return $this->db->where('id', $id)
            ->where('user_id', $user_id)
            ->delete('documents');
    }

    // Return only starred documents.
    public function get_important_list($user_id, $category = null)
    {
        $this->db->where('user_id', $user_id)->where('is_important', 1);

        if (!empty($category) && $category !== 'All') {
            $this->db->where('category', strtolower($category));
        }

        return $this->db->order_by('starred_at', 'DESC')
            ->get('documents')->result();
    }

    // Number of starred documents inside one category.
    public function get_important_category_total($user_id, $category)
    {
        return $this->db->where('user_id', $user_id)
            ->where('is_important', 1)
            ->where('category', strtolower($category))
            ->count_all_results('documents');
    }

    // Most recently starred document.
    public function get_last_important_document($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->where('is_important', 1)
            ->where('starred_at IS NOT NULL', null, false)
            ->order_by('starred_at', 'DESC')
            ->limit(1)
            ->get('documents')->row();
    }

    // Recent uploads are displayed by the navbar notification bell.
    public function get_recent_notifications($user_id, $limit = 5)
    {
        return $this->db->where('user_id', $user_id)
            ->order_by('uploaded_at', 'DESC')
            ->limit($limit)
            ->get('documents')->result();
    }

    // Number of uploads made during the last 24 hours.
    public function get_recent_notification_count($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->where('uploaded_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')))
            ->count_all_results('documents');
    }

    // Count of all important documents for a user
    public function get_important_count($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('is_important', 1)
            ->count_all_results('documents');
    }

    // Count of important Identity-category documents for a user
    public function get_identity_important_count($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('is_important', 1)
            ->where('category', 'Identity')
            ->count_all_results('documents');
    }

    // Most recent uploaded_at of an important document
    public function get_last_starred_date($user_id)
    {
        $this->db->select('MAX(uploaded_at) AS last_starred');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_important', 1);
        $query = $this->db->get('documents');
        $row   = $query->row();
        return ($row && $row->last_starred) ? $row->last_starred : NULL;
    }
}
?>