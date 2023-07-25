<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function index()
  {
    $this->load->model("dashboard_model");
    $data['karyawan'] = $this->dashboard_model->countkaryawan();
    $data['unit'] = $this->dashboard_model->countunit();
    $data['timesheet'] = $this->dashboard_model->counttimesheet();
    $data['jam'] = $this->dashboard_model->countjam()->result_array();
    $data['genderData'] = $this->dashboard_model->getGenderData();

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


    $kosong = $this->db->query("SELECT COUNT(*) AS total
                          FROM timesheet
                          WHERE konfirmasi = ''");
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
  }
}
