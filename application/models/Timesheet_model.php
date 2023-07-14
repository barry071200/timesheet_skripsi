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

    $currentYear = date('Y');
    $this->db->select('*');
    $this->db->from('timesheet');
    $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan', 'left');
    $this->db->join('unit', 'unit.id_unit = timesheet.id_unit', 'left');
    $this->db->where("YEAR(tanggal) =", $currentYear);
    $this->db->order_by('tanggal', 'desc');
    return $this->db->get();
  }
  public function ditolak()
  {

    $currentYear = date('Y');
    $this->db->select('*');
    $this->db->from('timesheet');
    $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan', 'left');
    $this->db->join('unit', 'unit.id_unit = timesheet.id_unit', 'left');
    $this->db->where("YEAR(tanggal) =", $currentYear);
    $this->db->where('timesheet.konfirmasi', 'DITOLAK');
    $this->db->order_by('tanggal', 'desc');
    return $this->db->get();
  }
  public function sumharga($id)
  {
    $this->db->from('timesheet, unit');
    $this->db->select('sum(unit.harga*(timesheet.hm_akhir-timesheet.hm_awal))', FALSE);
    $this->db->where('unit.id_unit=', $id);
    $this->db->where('timesheet.id_unit=', $id);
    $query = $this->db->get('');
    return ($query);
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
  public function sumjam($id)
  {
    $this->db->from('timesheet, karyawan');
    $this->db->select('sum(timesheet.hm_akhir-timesheet.hm_awal)', FALSE);
    $this->db->where('karyawan.id_karyawan=', $id);
    $this->db->where('timesheet.id_karyawan=', $id);
    $query = $this->db->get('');
    return ($query);
  }
  public function ubah_data($id, $data)
  {
    $this->db->where('id_timesheet', $id);
    $this->db->update('timesheet', $data);
  }
}
