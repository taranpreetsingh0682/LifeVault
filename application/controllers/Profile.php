<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('User_model');
  }

  public function profile() {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $data['user'] = $this->User_model->getUserById($this->session->userdata('user_id'));
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('profile/profile', $data);
    $this->load->view('templates/footer');
  }

  public function index() {
    $this->profile();
  }

  public function update() {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $name = trim($this->input->post('name'));
    $email = trim($this->input->post('email'));
    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $this->session->set_flashdata('error', 'Enter a name and valid email address.'); redirect('profile'); return; }
    $existing = $this->User_model->getUserByEmail($email);
    if ($existing && (int) $existing->id !== (int) $this->session->userdata('user_id')) { $this->session->set_flashdata('error', 'That email address is already in use.'); redirect('profile'); return; }
    $this->User_model->updateProfile($this->session->userdata('user_id'), array('name' => $name, 'email' => $email, 'phone_number' => trim($this->input->post('phone_number')), 'country' => trim($this->input->post('country'))));
    $this->session->set_userdata(array('name' => $name, 'email' => $email)); $this->session->set_flashdata('success', 'Profile updated.'); redirect('profile');
  }

  public function changePassword() {
    if (!$this->session->userdata('loggend_in')) { redirect('auth/login'); return; }
    $user = $this->User_model->getUserById($this->session->userdata('user_id')); $current = $this->input->post('current_password'); $new = $this->input->post('new_password');
    if (!password_verify($current, $user->password) || strlen($new) < 6 || $new !== $this->input->post('confirm_password')) { $this->session->set_flashdata('error', 'Check your current password; new passwords must match and be at least 6 characters.'); redirect('profile'); return; }
    $this->User_model->updatePassword($user->id, password_hash($new, PASSWORD_DEFAULT)); $this->session->set_flashdata('success', 'Password changed successfully.'); redirect('profile');
  }
}
?>
