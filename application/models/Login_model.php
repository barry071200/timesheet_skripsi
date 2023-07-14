<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Login_model
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

class Login_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function cek($username, $pw)
  {
    $this->db->select('*');
    $this->db->where('username', $username);
    $this->db->where('password', $pw);
    $this->db->from('users');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return FALSE;
    }
  }
}

  // ------------------------------------------------------------------------



/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */