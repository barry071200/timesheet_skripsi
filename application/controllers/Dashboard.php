<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function index()
  {
    if ($this->session->userdata('logged_in') == TRUE) {
      $this->load->model("dashboard_model");
      $data['karyawan'] = $this->dashboard_model->countkaryawan();
      $data['unit'] = $this->dashboard_model->countunit();
      $data['timesheet'] = $this->dashboard_model->counttimesheet();
      $data['jam'] = $this->dashboard_model->countjam()->result_array();
      $data['genderData'] = $this->dashboard_model->getGenderData();

      $users = $this->db->query(
        "SELECT COUNT(id_user) as role_count FROM users"
      );
      $data['users'] = $users->row_array();

      $timesheet_deleted = $this->db->query(
        "SELECT COUNT(id) as role_count FROM timesheet_deleted"
      );
      $data['timesheet_deleted'] = $timesheet_deleted->row_array();

      $karyawan_deleted = $this->db->query(
        "SELECT COUNT(id) as role_count FROM karyawan_deleted"
      );
      $data['karyawan_deleted'] = $karyawan_deleted->row_array();

      $unit_deleted = $this->db->query(
        "SELECT COUNT(id) as role_count FROM unit_deleted"
      );
      $data['unit_deleted'] = $unit_deleted->row_array();



      $query = $this->db->query(
        "SELECT timesheet.id_karyawan, karyawan.nama_karyawan, 
      DATE_FORMAT(timesheet.tanggal, '%M %Y') AS bulan, SUM(timesheet.hm_akhir - timesheet.hm_awal) AS jam 
      FROM timesheet 
      JOIN karyawan ON timesheet.id_karyawan = karyawan.id_karyawan
      WHERE timesheet.tanggal IS NULL OR 
      (MONTH(timesheet.tanggal) = MONTH(CURDATE()) AND YEAR(timesheet.tanggal) = YEAR(CURDATE()))
      GROUP BY timesheet.id_karyawan, karyawan.nama_karyawan, bulan 
      ORDER BY jam DESC 
      LIMIT 5"
      );

      $data['chartData'] = $query->result_array();
      $jenis = $this->db->query("SELECT perusahaan, COUNT(*) as jumlah_unit from unit group by perusahaan");
      $data['jenis'] = $jenis->result_array();
      $hm_bulan = $this->db->query("SELECT
                                  DATE_FORMAT(tanggal, '%M') AS bulan,
                                  SUM(hm_akhir - hm_awal) AS total_selisih
                                  FROM timesheet
                                  WHERE YEAR(tanggal) = YEAR(CURDATE())
                                  GROUP BY bulan
                                  ORDER BY MONTH(tanggal) asc");
      $data['hm_bulan'] = $hm_bulan->result_array();


      $today = date('Y-m-d');
      $range_start = date('Y-m-d', strtotime('-360 days', strtotime($today)));
      $kosong = $this->db->query("SELECT COUNT(*) AS total
                                FROM timesheet
                                WHERE konfirmasi = '' AND tanggal BETWEEN '$range_start' AND '$today'");
      $total = $kosong->row()->total;


      $ditolak = $this->db->query("SELECT COUNT(*) AS jumlah
                            FROM timesheet
                            WHERE konfirmasi = 'DITOLAK'");
      $jumlah = $ditolak->row()->jumlah;
      $data['jumlah'] = $jumlah;
      $data['total'] = $total;
      $data['judul'] = "Dashboard";
      $data['layout'] = "dashboard";
      $this->load->view('template', $data);
    } else {
      redirect('login/index');
    }
  }
}
