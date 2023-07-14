<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_model extends CI_Model
{

    public function getJenis()
    {
        $query = $this->db->get('jenis');
        return $query->result_array();
    }
}
