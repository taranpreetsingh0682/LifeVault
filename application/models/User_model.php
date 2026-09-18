<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->ensureSchema();
    }

    private function ensureSchema()
    {
        static $checked = false;
        if ($checked) return;
        $checked = true;

        try {
            $this->db->query("CREATE TABLE IF NOT EXISTS `users` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `email` varchar(100) NOT NULL,
                `country` varchar(100) NOT NULL DEFAULT '',
                `phone_number` varchar(20) NOT NULL DEFAULT '',
                `password` varchar(255) NOT NULL,
                `profile_image` varchar(255) NOT NULL DEFAULT '',
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `reset_token` varchar(255) DEFAULT NULL,
                `reset_expires` datetime DEFAULT NULL,
                `remember_token_hash` varchar(255) DEFAULT NULL,
                `remember_token_expires` datetime DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

            $this->db->query("CREATE TABLE IF NOT EXISTS `documents` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `title` varchar(150) NOT NULL,
                `category` varchar(50) NOT NULL,
                `file_name` varchar(255) NOT NULL,
                `file_path` varchar(255) NOT NULL,
                `file_size` int(11) NOT NULL,
                `file_type` varchar(50) NOT NULL,
                `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `is_important` tinyint(1) NOT NULL DEFAULT 0,
                `is_shared` tinyint(1) NOT NULL DEFAULT 0,
                `starred_at` datetime DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `user_id` (`user_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
        } catch (Throwable $e) {
            log_message('error', 'SCHEMA INIT EXCEPTION: ' . $e->getMessage());
        }
    }

    public function insertUser($data)
    {
        return $this->db->insert('users', $data);
    }


    public function getUserByEmail($email)
    {
        return $this->db
            ->where('email', $email)
            ->get('users')
            ->row();
    }

    public function saveResetToken($user_id, $data)
    {
        return $this->db
            ->where('id', $user_id)
            ->update('users', $data);
    }

    public function getUserByResetToken($token)
    {
        return $this->db
            ->where('reset_token', $token)
            ->get('users')
            ->row();
    }

    public function updatePassword($user_id, $hashed_password)
    {
        return $this->db
            ->where('id', $user_id)
            ->update('users', array('password' => $hashed_password));
    }

    public function clearResetToken($user_id)
    {
        return $this->db
            ->where('id', $user_id)
            ->update('users', array(
                'reset_token'   => NULL,
                'reset_expires' => NULL
            ));
    }

    // auth token:-

    public function saveRememberToken($user_id, $token_hash, $expires)
    {
        return $this->db
            ->where('id', $user_id)
            ->update('users', [
                'remember_token_hash' => $token_hash,
                'remember_token_expires' => $expires
            ]);
    }


    public function getUserByRememberToken($token_hash)
    {
        return $this->db
            ->where('remember_token_hash', $token_hash)
            ->where('remember_token_expires >', date('Y-m-d H:i:s'))
            ->get('users')
            ->row();
    }


    public function clearRememberToken($user_id)
    {
        return $this->db
            ->where('id', $user_id)
            ->update('users', [
                'remember_token_hash' => NULL,
                'remember_token_expires' => NULL
            ]);
    }

    public function getUserById($user_id)
    {
        return $this->db->where('id', $user_id)->get('users')->row();
    }

    public function updateProfile($user_id, $data)
    {
        return $this->db->where('id', $user_id)->update('users', $data);
    }

}
