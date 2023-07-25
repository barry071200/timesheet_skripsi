<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Login
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view('login');
  }

  public function cek()
  {
    $this->load->model('login_model');
    $post = $this->input->post();
    $username = $post['username'];
    $pw = $post['password'];

    $status = $this->login_model->cek($username, $pw);
    if ($status == true) {
      $username = $this->input->post('username');
      $this->session->set_userdata('username', $username);
      $data = $status->row_array();
      $id_user = $data['id_user'];
      $username = $data['username'];
      $pw = $data['password'];
      $role = $data['role'];
      $setdata = array(
        'id_user' => $id_user,
        'username' => $username,
        'password' => $pw,
        'role' => $role,
        'logged_in' => TRUE

      );
      $this->session->set_userdata($setdata);
      $this->db->query("CALL log_login($id_user)");
      $this->db->query("CALL delete_old_karyawan_deleted()");
      $this->db->query("CALL delete_old_timesheet_deleted()");
      $this->db->query("CALL delete_old_unit_deleted()");
      if ($data['role'] == '1') {
        redirect('dashboard/index');
      } else {
        if ($data['role'] == '2') {
          redirect('dashboard/index');
        } elseif ($data['role'] == '3') {
          redirect('dashboard/index');
        } elseif ($data['role'] == '4') {
          redirect('dashboard/index');
        } elseif ($data['role'] == '5') {
          redirect('dashboard/index');
        }
      }
    } else {
      $this->session->set_flashdata('error', 'Username atau Password Salah!!');
      redirect('login/index');
    }
  }

  public function logout()
  {
    $id_user = $this->session->userdata('id_user');
    $this->db->query("CALL log_logout($id_user)");
    session_destroy();
    redirect('login/index');
  }
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */