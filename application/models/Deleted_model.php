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
        $this->db->select('*');
        $this->db->from('timesheet_deleted');
        $this->db->join('karyawan', 'timesheet_deleted.id_karyawan = karyawan.id_karyawan', 'left');
        $this->db->join('unit', 'unit.id_unit = timesheet_deleted.id_unit', 'left');
        $this->db->order_by('deleted_at', 'desc');
        return $this->db->get();
    }
}
