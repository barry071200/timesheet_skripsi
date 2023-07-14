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

class Unit extends CI_Controller
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
    if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '4' or $this->session->userdata('role') == '5' or $this->session->userdata('role') == '3') {
      $this->load->model('Unit_model');
      $this->load->model('Jenis_model');
      $data['unit'] = $this->Unit_model->ambil()->result_array();
      $data['jenis'] = $this->Jenis_model->getJenis();
      $data['layout'] = 'unit/index';
      $data['judul'] = 'Data Unit';
      $this->load->view('template', $data);
    }
  }
  public function tambah()
  {
    if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '4') {
      $this->load->model('unit_model');
      $data = array();
      $post = $this->input->post();
      $data['nama_unit'] = $post['nama_unit'];
      $data['tahun'] = $post['tahun'];
      $data['perusahaan'] = $post['perusahaan'];
      $data['harga'] = $post['harga'];
      $this->unit_model->tambah($data);
      $this->session->set_flashdata('admin_save_success', "data berhasil Dimasukan");
      redirect('unit/index');
    }
  }
  public function clear_flash_data()
  {
    $this->session->unset_userdata('admin_save_success');
    $this->session->unset_userdata('admin_hapus_success');
  }
  public function edit()
  {
    if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '4') {
      $data = array();
      $this->load->model('Unit_model');
      $post = $this->input->post();
      $id = $post['id_unit'];
      $data['nama_unit'] = $post['nama_unit'];
      $data['perusahaan'] = $post['perusahaan'];
      $data['harga'] = $post['harga'];
      $data['tahun'] = $post['tahun'];
      $this->Unit_model->ubah_data($id, $data);
      $this->session->set_flashdata('admin_save_success', "Update berhasil Dimasukan");
      redirect('unit/index');
    }
  }
  public function delete($id)
  {
    if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '4') {
      $this->load->model('Unit_model');
      $this->Unit_model->hapus_data($id);
      redirect('unit/index');
    }
  }
  public function sheet($id)
  {
    $this->load->model('unit_model');
    $this->load->model('Timesheet_model');
    $data['unit'] = $this->unit_model->sheet($id)->result_array();
    $data['sum'] = $this->Timesheet_model->sumharga($id)->result_array();
    $data['layout'] = 'unit/Laporan';
    $data['judul'] = 'Data Timesheet';
    $this->load->view('template', $data);
  }
}


/* End of file Unit.php */
/* Location: ./application/controllers/Unit.php */