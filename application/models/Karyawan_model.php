<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Karyawan_model
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

class Karyawan_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function ambil()
  {
    $this->db->select('*');
    $this->db->from('karyawan');
    return $this->db->get('');
  }

  public function tambah($data)
  {
    $tabel = "karyawan";
    $this->db->insert($tabel, $data);
  }
  public function hapus_data($id)
  {
    $this->db->where('id_karyawan', $id);
    $this->db->delete('karyawan');
  }
  public function ubah_data($id, $data)
  {
    $this->db->where('id_karyawan', $id);
    $this->db->update('karyawan', $data);
  }
  public function sheet($id)
  {
    $this->db->select('*');
    $this->db->from('timesheet');
    $this->db->join('unit', 'unit.id_unit = timesheet.id_unit', 'left');
    $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan', 'left');
    $this->db->where('karyawan.id_karyawan', $id);
    $this->db->where('YEAR(timesheet.tanggal)', date('Y'));
    $this->db->order_by('timesheet.tanggal', 'desc');
    return $this->db->get();
  }


  // ------------------------------------------------------------------------

}

/* End of file Karyawan_model.php */
/* Location: ./application/models/Karyawan_model.php */