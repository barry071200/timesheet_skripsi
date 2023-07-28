<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Timesheet
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

class Arsip extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //$this->load->library('session');
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('login/index');
        }
    }


    public function index()
    {
        if ($this->session->userdata('role') == '1') {
            $this->load->model('Timesheet_model');
            $data['timesheet'] = $this->Timesheet_model->ambil()->result_array();
            $data['layout'] = 'arsip/index';
            $data['judul'] = 'Arsip Data Timesheet';
            $this->load->view('template', $data);
        } else {
            redirect('login/index');
        }
    }
}


/* End of file Timesheet.php */
/* Location: ./application/controllers/Timesheet.php */