<?php
class Deleted extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Deleted_model');
    }

    public function timesheet()
    {
        if ($this->session->userdata('role') == '1') {
            $data['deleted_timesheet'] = $this->Deleted_model->get_deleted_timesheet();
            $data['judul'] = "Data Timesheet";
            $data['layout'] = "deleted/timesheet";
            $this->load->view('template', $data);
        } else {
            session_destroy();
            redirect('login/index');
        }
    }
    public function karyawan()
    {
        if ($this->session->userdata('role') == '1') {
            $data['deleted_karyawan'] = $this->Deleted_model->get_deleted_karyawan();
            $data['judul'] = "Data Karyawan";
            $data['layout'] = "deleted/karyawan";
            $this->load->view('template', $data);
        } else {
            session_destroy();
            redirect('login/index');
        }
    }
    public function unit()
    {
        if ($this->session->userdata('role') == '1') {
            $data['deleted_unit'] = $this->Deleted_model->get_deleted_unit();
            $data['judul'] = "Data Unit";
            $data['layout'] = "deleted/unit";
            $this->load->view('template', $data);
        } else {
            session_destroy();
            redirect('login/index');
        }
    }
}
