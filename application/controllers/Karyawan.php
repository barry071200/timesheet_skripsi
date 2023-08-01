<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
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
    if ($this->session->userdata('role') == '4' or $this->session->userdata('role') == '5' or $this->session->userdata('role') == '3') {
      $this->load->model('karyawan_model');
      $data['karyawan'] = $this->karyawan_model->ambil()->result_array();
      $data['judul'] = "Data Karyawan";
      $data['layout'] = "karyawan/index";
      $this->load->view('template', $data);
    }
  }

  public function tambah()
  {
    if ($this->session->userdata('role') == '4') {
      $this->load->model('karyawan_model');
      $data = array();
      $post = $this->input->post();
      $data['nama_karyawan'] = $post['nama_karyawan'];
      $data['alamat'] = $post['alamat'];
      $data['no_telpon'] = $post['no_telpon'];
      $data['tgl_lahir'] = $post['tgl_lahir'];
      $data['jenis_kelamin'] = $post['jenis_kelamin'];
      $data['premi'] = $post['premi'];
      $this->karyawan_model->tambah($data);
      $this->session->set_flashdata('admin_save_success', 'Tambah berhasil');
      redirect('karyawan/index');
    }
  }
  public function clear_flash_data()
  {
    $this->session->unset_userdata('admin_save_success');
    $this->session->unset_userdata('admin_hapus_success');
  }

  public function delete($id)
  {
    if ($this->session->userdata('role') == '4') {
      $this->load->model("karyawan_model");
      $this->karyawan_model->hapus_data($id);
      redirect('karyawan/index');
    }
  }
  public function edit()
  {
    if ($this->session->userdata('role') == '4') {
      $data = array();
      $this->load->model('karyawan_model');
      $post = $this->input->post();
      $id = $post['id_karyawan'];
      $data['nama_karyawan'] = $post['nama_karyawan'];
      $data['alamat'] = $post['alamat'];
      $data['no_telpon'] = $post['no_telpon'];
      $data['tgl_lahir'] = $post['tgl_lahir'];
      $data['jenis_kelamin'] = $post['jenis_kelamin'];
      $data['premi'] = $post['premi'];

      $this->karyawan_model->ubah_data($id, $data);
      $this->session->set_flashdata('admin_save_success', "data berhasil Diupdate");
      redirect('karyawan/index');
    }
  }
  public function sheet($id)
  {
    $this->load->model('Timesheet_model');
    $this->load->model('karyawan_model');
    $data['karyawan'] = $this->karyawan_model->sheet($id)->result_array();
    $data['layout'] = 'karyawan/Laporan';
    $data['judul'] = 'Data Timesheet';
    $this->load->view('template', $data);
  }
  public function cetak($id)
  {
    $this->load->model('karyawan_model');
    $data['layout'] = 'karyawan/Laporan';
    $data['judul'] = 'karyawan/Timesheet';
    $this->load->view('template', $data);
  }
}
