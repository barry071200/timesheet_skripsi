<?php
class Deleted_model extends CI_Model
{
    public function get_deleted_karyawan()
    {
        $query = $this->db->get('karyawan_deleted');
        return $query->result_array();
    }
    public function get_deleted_unit()
    {
        $query = $this->db->get('unit_deleted');
        return $query->result_array();
    }
    public function get_deleted_timesheet()
    {
        $query = $this->db->get('timesheet_deleted');
        return $query->result_array();
    }
}
