<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Cetak
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

class Cetak extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->model('cetak_model');
    $data['cetak'] = $this->cetak_model->index()->result_array();
    $this->load->view('timesheet/cetak', $data);
   

  }

}


/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */