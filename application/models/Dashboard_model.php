<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Dashboard_model
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

class Dashboard_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function countkaryawan()
  {
    return $this->db->count_all('karyawan');
  }
  public function countunit()
  {
    return $this->db->count_all('unit');
  }
  public function counttimesheet()
  {
    $currentYear = date('Y');

    $this->db->where("YEAR(tanggal) = $currentYear");
    $count = $this->db->count_all_results('timesheet');

    return $count;
  }
  public function countjam()
  {
    $this->db->select('(SELECT SUM(hm_akhir)-SUM(hm_awal) from timesheet) as jam', FALSE);
    $query = $this->db->get();
    return $query;
  }
  public function getGenderData()
  {
    $query = $this->db->query('
            SELECT
                COUNT(*) AS total,
                ROUND(COUNT(*) * 100 / (SELECT COUNT(*) FROM karyawan), 2) AS percentage,
                jenis_kelamin
            FROM
                karyawan
            GROUP BY
                jenis_kelamin
        ');

    return $query->result_array();
  }


  // ------------------------------------------------------------------------

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */