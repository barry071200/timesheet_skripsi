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

class Arsip_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function ambil()
    {
        $this->db->select('*');
        $this->db->from('timesheet');
        $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan', 'left');
        $this->db->join('unit', 'unit.id_unit = timesheet.id_unit', 'left');
        $this->db->order_by('tanggal', 'desc');
        return $this->db->get();
    }
}
