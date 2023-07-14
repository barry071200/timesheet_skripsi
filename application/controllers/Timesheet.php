<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Timesheet
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

class Timesheet extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    //$this->load->library('session');
    if ($this->session->userdata('logged_in') !== TRUE) {
      redirect('login/index');
    }
  }


  public function index()
  {
    if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '5') {
      $this->load->model('Timesheet_model');
      $data['timesheet'] = $this->Timesheet_model->ambil()->result_array();
      $data['unit'] = $this->Timesheet_model->unit()->result();
      $data['karyawan'] = $this->Timesheet_model->karyawan()->result();
      $data['layout'] = 'timesheet/index';
      $data['judul'] = 'Data Timesheet';
      $this->load->view('template', $data);
    } else {
      redirect('login/index');
    }
  }
  public function ditolak()
  {
    if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '5') {
      $this->load->model('Timesheet_model');
      $data['timesheet'] = $this->Timesheet_model->ditolak()->result_array();
      $data['unit'] = $this->Timesheet_model->unit()->result();
      $data['karyawan'] = $this->Timesheet_model->karyawan()->result();
      $data['layout'] = 'timesheet/ditolak';
      $data['judul'] = 'Data Timesheet';
      $this->load->view('template', $data);
    } else {
      redirect('login/index');
    }
  }


  public function tambah()
  {
    if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '5') {
      $this->load->model('timesheet_model');

      // Jika validasi berhasil, proses data tambahan
      $data = array();
      $post = $this->input->post();
      $data['id_karyawan'] = $post['id_karyawan'];
      $data['tanggal'] = $post['tanggal'];
      $data['id_unit'] = $post['id_unit'];
      $data['hm_awal'] = $post['hm_awal'];
      $data['hm_akhir'] = $post['hm_akhir'];
      $data['keterangan'] = $post['keterangan'];
      $this->timesheet_model->tambah($data);
      $this->session->set_flashdata('admin_save_success', 'Tambah berhasil');
      redirect('timesheet/index');
    } else {
      redirect('login/index');
    }
  }


  public function delete($id)
  {
    if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '5') {
      $this->load->model('timesheet_model');
      $this->timesheet_model->hapus($id);
      $this->session->set_flashdata('admin_hapus_success', 'Hapus berhasil');
      redirect('timesheet/index');
    } else {
      redirect('login/index');
    }
  }
  public function coba()
  {

    $this->load->model('cetak_model');
    $data = $this->cetak_model->coba()->result();
    var_dump($data);
  }
  public function edit()
  {
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
    redirect('timesheet/index');
  }

  public function clear_flash_data()
  {
    $this->session->unset_userdata('admin_save_success');
    $this->session->unset_userdata('admin_hapus_success');
  }


  public function unit()
  {
    $this->load->model('Unit_model');
    $data['unit'] = $this->Unit_model->ambil()->result_array();
    $data['layout'] = 'timesheet/index';
    $data['judul'] = 'Data Unit';
    $this->load->view('template', $data);
  }

  public function karyawan()
  {

    $this->load->model('karyawan_model');
    $data['karyawan'] = $this->karyawan_model->ambil()->result_array();
    $data['judul'] = "Data Karyawan";
    $data['layout'] = "timesheet/index";
    $this->load->view('template', $data);
  }
}


/* End of file Timesheet.php */
/* Location: ./application/controllers/Timesheet.php */