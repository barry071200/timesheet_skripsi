

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
    $password = $post['password'];

    $status = $this->login_model->cek($username, $password);
    if ($status !== FALSE) {
      $username = $status->username;
      $this->session->set_userdata('username', $username);
      $id_user = $status->id_user;
      $role = $status->role;
      $setdata = array(
        'id_user' => $id_user,
        'username' => $username,
        'role' => $role,
        'logged_in' => TRUE
      );
      $this->session->set_userdata($setdata);
      $this->db->query("CALL log_login($id_user)");
      $this->db->query("CALL delete_old_karyawan_deleted()");
      $this->db->query("CALL delete_old_timesheet_deleted()");
      $this->db->query("CALL delete_old_unit_deleted()");
      $this->db->query("CALL delete_old_user_sessions()");
      redirect('dashboard/index');
    } else {
      $this->session->set_flashdata('error', 'Username atau Password Salah!!');
      redirect('login/index');
    }
  }




  public function logout()
  {
    $id_user = $this->session->userdata('id_user');
    if ($id_user !== NULL) {
      $this->db->query("CALL log_logout($id_user)");
    }
    $this->session->sess_destroy();
    redirect('login/index');
  }
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */