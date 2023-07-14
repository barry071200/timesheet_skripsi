<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Unit
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Pengguna extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('login/index');
        }
    }

    public function index()
    {

        if ($this->session->userdata('role') == '1') {
            $this->load->model('Pengguna_model');
            $data['user'] = $this->Pengguna_model->ambil()->result_array();
            $data['layout'] = 'pengguna/index';
            $data['judul'] = 'Data User';
            $this->load->view('template', $data);
        } else {
            session_destroy();
            redirect('login/index');
        }
    }
    public function clear_flash_data()
    {
        $this->session->unset_userdata('admin_save_success');
        $this->session->unset_userdata('admin_hapus_success');
    }

    public function tambah()
    {
        if ($this->session->userdata('role') == '1') {
            $this->load->model('Pengguna_model');
            $data = array();
            $post = $this->input->post();
            $data['username'] = $post['username'];
            $data['password'] = $post['password'];
            $data['role'] = $post['role'];

            $this->Pengguna_model->tambah($data);
            $this->session->set_flashdata('admin_save_success', 'Tambah berhasil');
            redirect('pengguna/index');
        } else {
            redirect('login/index');
        }
    }
    public function delete($id)
    {
        $this->load->model("pengguna_model");
        $this->pengguna_model->hapus_data($id);
        redirect('pengguna/index');
    }
    public function edit()
    {

        $data = array();
        $this->load->model('pengguna_model');
        $post = $this->input->post();
        $id = $post['id_user'];
        $data['id_user'] = $post['id_user'];
        $data['username'] = $post['username'];
        $data['password'] = $post['password'];
        $data['role'] = $post['role'];
        $this->pengguna_model->ubah_data($id, $data);
        $this->session->set_flashdata('admin_save_success', 'Update berhasil');
        redirect('pengguna/index');
        $this->session->set_flashdata('admin_save_success', "data berhasil Dimasukan");
    }
}


/* End of file Unit.php */
/* Location: ./application/controllers/Unit.php */