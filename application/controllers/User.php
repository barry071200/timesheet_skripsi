<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            redirect('login');
        }
        $user = $this->User_model->getUserById($id_user);
        $data['user'] = $user;
        $data['layout'] = 'change_user_data';
        $data['judul'] = '';
        $this->load->view('template', $data);

        $this->load->view('change_user_data', $data);
    }

    public function update()
    {
        $id_user = $this->session->userdata('id_user');
        $newUsername = $this->input->post('username');
        $newPassword = $this->input->post('password');
        $data = array(
            'username' => $newUsername,
            'password' => password_hash($newPassword, PASSWORD_BCRYPT)
        );
        $this->User_model->updateUser($id_user, $data);
        redirect('login/logout');
    }
}
