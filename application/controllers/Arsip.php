<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
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
            $this->load->model('Timesheet_model');
            $data['timesheet'] = $this->Timesheet_model->arsip()->result_array();
            $data['unit'] = $this->Timesheet_model->unit()->result();
            $data['karyawan'] = $this->Timesheet_model->karyawan()->result();
            $data['layout'] = 'arsip/index';
            $data['judul'] = 'Arsip Data Timesheet';
            $this->load->view('template', $data);
        } else {
            redirect('login/index');
        }
    }
    public function edit()
    {
        if ($this->session->userdata('role') == '1') {
            $data = array();
            $this->load->model('timesheet_model');
            $post = $this->input->post();
            $id = $post['id_timesheet'];
            $data['id_timesheet'] = $post['id_timesheet'];
            $data['id_unit'] = $post['id_unit'];
            $data['id_karyawan'] = $post['id_karyawan'];
            $data['tanggal'] = $post['tanggal'];
            $data['hm_awal'] = $post['hm_awal'];
            $data['hm_akhir'] = $post['hm_akhir'];
            $data['keterangan'] = $post['keterangan'];
            $this->timesheet_model->ubah_data($id, $data);
            $this->session->set_flashdata('admin_save_success', 'Update berhasil');
            redirect('arsip/index');
        }
    }
    public function delete($id)
    {
        if ($this->session->userdata('role') == '1') {
            $this->load->model('timesheet_model');
            $this->timesheet_model->hapus($id);
            $this->session->set_flashdata('admin_hapus_success', 'Hapus berhasil');
            redirect('arsip/index');
        } else {
            redirect('login/index');
        }
    }
}
