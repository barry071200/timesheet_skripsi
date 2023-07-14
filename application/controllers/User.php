<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller User
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

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
  }

  public function index()
  {

    $data['user'] = $this->user_model->index()->result_array();
    $data['layout'] = "user/index";
    $data['judul'] = "Data User";
    $this->load->view('template', $data);
  }
}


/* End of file User.php */
/* Location: ./application/controllers/User.php */