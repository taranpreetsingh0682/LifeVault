<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

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

}