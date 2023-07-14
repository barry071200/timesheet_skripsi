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
    // Jika data tidak dikirim dari view, isi dengan bulan dan tahun saat ini
    if (empty($selectedMonth) && empty($selectedYear)) {
      $selectedMonth = date('m');
      $selectedYear = date('Y');
    }

    // Buat kondisi untuk filter bulan dan tahun
    $filterCondition = "";
    if (!empty($selectedMonth) && !empty($selectedYear)) {
      $filterCondition = "AND MONTH(timesheet.tanggal) = $selectedMonth AND YEAR(timesheet.tanggal) = $selectedYear";
    } elseif (!empty($selectedMonth) && $selectedMonth !== 'all') {
      $filterCondition = "AND MONTH(timesheet.tanggal) = $selectedMonth";
    } elseif (!empty($selectedYear)) {
      $filterCondition = "AND YEAR(timesheet.tanggal) = $selectedYear";
    }

    $query = $this->db->query(
      "SELECT timesheet.id_karyawan, karyawan.nama_karyawan, 
        DATE_FORMAT(timesheet.tanggal, '%M %Y') AS bulan, SUM(timesheet.hm_akhir - timesheet.hm_awal) AS jam 
      FROM timesheet 
      JOIN karyawan ON timesheet.id_karyawan = karyawan.id_karyawan
      WHERE timesheet.tanggal IS NULL OR (MONTH(timesheet.tanggal) = $selectedMonth AND YEAR(timesheet.tanggal) = $selectedYear)
      $filterCondition
      GROUP BY timesheet.id_karyawan, karyawan.nama_karyawan, bulan 
      ORDER BY jam DESC 
      LIMIT 5"
    );

    // Mengirimkan data filter ke view
    $data['chartData'] = $query->result_array();



    $kosong = $this->db->query("SELECT COUNT(*) AS total
                        FROM timesheet
                        WHERE konfirmasi = ''");
    $total = $kosong->row()->total;

    $ditolak = $this->db->query("SELECT COUNT(*) AS jumlah
                          FROM timesheet
                          WHERE konfirmasi = 'DITOLAK'");
    $jumlah = $ditolak->row()->jumlah;
    // Memuat view dan mengirimkan data ke view
    $data['jumlah'] = $jumlah;
    $data['total'] = $total;
    $data['selectedMonth'] = $selectedMonth;
    $data['selectedYear'] = $selectedYear;
    $data['judul'] = "Dashboard";
    $data['layout'] = "dashboard";
    $this->load->view('template', $data);
  }
}
