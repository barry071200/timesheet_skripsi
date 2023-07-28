<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
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
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id_user = $this->session->userdata('id_user');
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );
            $this->User_model->updateUser($id_user, $data);
            $this->session->set_flashdata('admin_save_success', 'Username and password updated successfully!');
            session_destroy();
            redirect('login/index');
        }
    }
}
