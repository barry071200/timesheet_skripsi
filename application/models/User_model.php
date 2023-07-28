<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function getUserById($id_user)
    {
        // Get the user data from the database based on user_id
        $query = $this->db->get_where('users', array('id_user' => $id_user));
        return $query->row_array();
    }

    public function updateUser($id_user, $data)
    {
        // Update the user data in the database based on user_id
        $this->db->where('id_user', $id_user);
        $this->db->update('users', $data);
    }
}
