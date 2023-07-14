<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_model');
    }

    public function index()
    {
        $data['jenis'] = $this->Jenis_model->getJenis();
        $this->load->view('alat/index', $data);
    }
}
