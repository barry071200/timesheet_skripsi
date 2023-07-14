<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Unit_model
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

class Pengguna_model extends CI_Model
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
        return $this->db->get('users');
    }
    public function tambah($data)
    {
        $this->db->insert('users', $data);
    }
    public function hapus_data($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('users');
    }
    public function ubah_data($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('users', $data);
    }




    // ------------------------------------------------------------------------

}

/* End of file Unit_model.php */
/* Location: ./application/models/Unit_model.php */