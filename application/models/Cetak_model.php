<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Cetak_model
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

class Cetak_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    $this->db->select('*');
    $this->db->from('timesheet, karyawan');
    $this->db->join('unit', 'where timesheet.id_karyawan = karyawan.id_karyawan AND timesheet.id_unit = unit.id_unit');
    return $this->db->get('');
  }
  public function coba()
  {

    return $this->db->get('timesheet');
  }

  // ------------------------------------------------------------------------

}

/* End of file Cetak_model.php */
/* Location: ./application/models/Cetak_model.php */