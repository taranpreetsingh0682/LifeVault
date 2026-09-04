<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Config $config
 * @property CI_Session $session
 * @property CI_input $input
 * @property CI_User_model $User_model
 */
class Profile extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('User_model');
  }

  public function profile() {
    if (!$this->session->userdata('logged_in')) { redirect('auth/login'); return; }
    $user_id = $this->session->userdata('user_id');
    $data['user'] = $this->User_model->getUserById($user_id);
    if (!$data['user']) { redirect('auth/login'); return; }

    // Compute user initials
    $name_parts = preg_split('/\s+/', trim((string)$data['user']->name));
    $initials = !empty($name_parts[0]) ? strtoupper(substr($name_parts[0], 0, 1)) : 'L';
    if (count($name_parts) > 1) {
      $last = end($name_parts);
      $initials .= strtoupper(substr($last, 0, 1));
    }
    $data['user_initials'] = $initials ?: 'LV';

    // Storage statistics
    $storage_used = (float) $this->Document_model->get_storage_used($user_id);
    $storage_limit = 5 * 1024 * 1024 * 1024; // 5 GB
    $data['storage_used'] = $storage_used;
    $data['storage_limit'] = $storage_limit;
    $data['storage_percent'] = $storage_limit > 0 ? min(100, round(($storage_used / $storage_limit) * 100, 1)) : 0;
    $data['storage_used_gb'] = round($storage_used / 1073741824, 2);
    $data['storage_available_gb'] = round(max(0, $storage_limit - $storage_used) / 1073741824, 2);
    $data['storage_used_mb'] = round($storage_used / 1048576, 1);

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('profile/profile', $data);
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->profile();
  }

  public function update() {
    if (!$this->session->userdata('logged_in')) { redirect('auth/login'); return; }
    $name = trim($this->input->post('name'));
    $email = trim($this->input->post('email'));
    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $this->session->set_flashdata('error', 'Enter a name and valid email address.'); redirect('profile'); return; }
    $existing = $this->User_model->getUserByEmail($email);
    if ($existing && (int) $existing->id !== (int) $this->session->userdata('user_id')) { $this->session->set_flashdata('error', 'That email address is already in use.'); redirect('profile'); return; }
    $this->User_model->updateProfile($this->session->userdata('user_id'), array('name' => $name, 'email' => $email, 'phone_number' => trim($this->input->post('phone_number')), 'country' => trim($this->input->post('country'))));
    $this->session->set_userdata(array('name' => $name, 'email' => $email)); $this->session->set_flashdata('success', 'Profile updated.'); redirect('profile');
  }

  public function changePassword() {
    if (!$this->session->userdata('logged_in')) { redirect('auth/login'); return; }
    $user = $this->User_model->getUserById($this->session->userdata('user_id')); $current = $this->input->post('current_password'); $new = $this->input->post('new_password');
    if (!password_verify($current, $user->password) || strlen($new) < 6 || $new !== $this->input->post('confirm_password')) { $this->session->set_flashdata('error', 'Check your current password; new passwords must match and be at least 6 characters.'); redirect('profile'); return; }
    $this->User_model->updatePassword($user->id, password_hash($new, PASSWORD_DEFAULT)); $this->session->set_flashdata('success', 'Password changed successfully.'); redirect('profile');
  }
}
