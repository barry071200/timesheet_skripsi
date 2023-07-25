<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Timesheet_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Timesheet_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function ambil()
  {
    $endDate = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime('-360 days'));
    $this->db->select('*');
    $this->db->from('timesheet');
    $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan', 'left');
    $this->db->join('unit', 'unit.id_unit = timesheet.id_unit', 'left');
    $this->db->where("tanggal BETWEEN '{$startDate}' AND '{$endDate}'");
    $this->db->order_by('tanggal', 'desc');
    return $this->db->get();
  }
  public function ditolak()
  {
    $endDate = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime('-360 days'));
    $this->db->select('*');
    $this->db->from('timesheet');
    $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan', 'left');
    $this->db->join('unit', 'unit.id_unit = timesheet.id_unit', 'left');
    $this->db->where('tanggal >=', $startDate);
    $this->db->where('tanggal <=', $endDate);
    $this->db->where('timesheet.konfirmasi', 'DITOLAK');
    $this->db->order_by('tanggal', 'desc');
    return $this->db->get();
  }
  public function tambah($data)
  {
    $this->db->insert('timesheet', $data);
  }
  public function hapus($id)
  {

    $this->db->where('id_timesheet', $id);
    $this->db->delete('timesheet');
  }
  public function unit()
  {
    $this->db->select('*');
    $this->db->from('unit');
    return $this->db->get('');
  }
  public function karyawan()
  {
    $this->db->select('*');
    $this->db->from('karyawan');
    return $this->db->get('');
  }
  public function ubah_data($id, $data)
  {
    $this->db->where('id_timesheet', $id);
    $this->db->update('timesheet', $data);
  }
}
