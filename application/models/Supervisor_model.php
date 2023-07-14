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

class Supervisor_model extends CI_Model
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
        $this->db->from('timesheet, unit');
        $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan AND unit.id_unit = timesheet.id_unit');
        $this->db->order_by('tanggal', 'desc');
        return $this->db->get('');
    }
    public function ditolak()
    {
        $this->db->select('*');
        $this->db->from('timesheet, unit');
        $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan AND unit.id_unit = timesheet.id_unit');
        $this->db->where('timesheet.konfirmasi', 'DITOLAK');
        $this->db->order_by('tanggal', 'desc');
        return $this->db->get('');
    }
    public function kosong()
    {
        $this->db->select('*');
        $this->db->from('timesheet, unit');
        $this->db->join('karyawan', 'timesheet.id_karyawan = karyawan.id_karyawan AND unit.id_unit = timesheet.id_unit');
        $this->db->where('timesheet.konfirmasi', '');
        $this->db->order_by('tanggal', 'desc');
        return $this->db->get('');
    }

    public function valid($id, $valid)
    {

        $this->db->set('konfirmasi', $valid);
        $this->db->where('id_timesheet', $id);
        $this->db->update('timesheet');
    }
    // ------------------------------------------------------------------------

}

/* End of file Timesheet_model.php */
/* Location: ./application/models/Timesheet_model.php */