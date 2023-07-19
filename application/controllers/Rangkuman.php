<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rangkuman extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('role') == '2' or $this->session->userdata('role') == '1') {
            $rangkum = $this->db->query("SELECT DATE_FORMAT(tanggal, '%M') AS bulan,
                                        YEAR(tanggal) AS tahun,
                                        SUM((ts.hm_akhir - ts.hm_awal) * u.harga) AS total_harga,
                                        SUM((ts.hm_akhir - ts.hm_awal) * k.premi) AS total_premi,
                                        SUM(ts.hm_akhir - ts.hm_awal) AS total_jam_kerja
                                        FROM timesheet ts
                                        JOIN karyawan k ON ts.id_karyawan = k.id_karyawan
                                        JOIN unit u ON ts.id_unit = u.id_unit
                                        WHERE YEAR(tanggal) BETWEEN 2018 AND YEAR(CURDATE())
                                        GROUP BY YEAR(tanggal), MONTH(tanggal)
                                        ORDER BY YEAR(tanggal) DESC, MONTH(tanggal) DESC");
            $data['rangkum'] = $rangkum->result_array();
            $data['judul'] = "Laporan Biaya Pengeluaran";
            $data['layout'] = "Rangkum/index";
            $this->load->view('template', $data);
        } else {
            session_destroy();
            redirect('login/index');
        }
    }
    public function index2()
    {
        if ($this->session->userdata('role') == '2' or $this->session->userdata('role') == '1' or $this->session->userdata('role') == '4') {
            $rangkum = $this->db->query("SELECT DATE_FORMAT(tanggal, '%M') AS bulan,
                                        YEAR(tanggal) AS tahun, u.perusahaan,
                                        SUM((ts.hm_akhir - ts.hm_awal) * u.harga) AS total_harga,
                                        SUM(ts.hm_akhir - ts.hm_awal) AS total_jam_kerja
                                        FROM timesheet ts
                                        JOIN unit u ON ts.id_unit = u.id_unit
                                        WHERE YEAR(tanggal) BETWEEN 2018 AND YEAR(CURDATE())
                                        GROUP BY YEAR(tanggal) desc, MONTH(tanggal) desc, u.perusahaan");
            $data['rangkum2'] = $rangkum->result_array();
            $detil = $this->db->query("SELECT
                                        DATE_FORMAT(tanggal, '%M') AS bulan,
                                        YEAR(tanggal) AS tahun, u.nama_unit, u.perusahaan, u.harga,
                                        SUM((ts.hm_akhir - ts.hm_awal) * u.harga) AS total_harga_sewa,
                                        SUM(ts.hm_akhir - ts.hm_awal) AS total_jam_kerja
                                        FROM timesheet ts
                                        JOIN unit u ON ts.id_unit = u.id_unit
                                        WHERE u.perusahaan IS NOT NULL
                                        GROUP BY YEAR(tanggal), bulan, u.nama_unit, u.perusahaan, u.harga
                                        ORDER BY YEAR(tanggal) DESC, MONTH(tanggal) DESC");
            $data['detil'] = $detil->result_array();
            $data['judul'] = "Laporan Biaya Sewa";
            $data['layout'] = "Rangkum/laporan";
            $this->load->view('template', $data);
        } else {
            session_destroy();
            redirect('login/index');
        }
    }
    public function index3()
    {
        if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '4') {
            $rangkum = $this->db->query("SELECT DATE_FORMAT(tanggal, '%M') AS bulan, 
                                        YEAR(tanggal) AS tahun, k.nama_karyawan,
                                        SUM((ts.hm_akhir - ts.hm_awal) * k.premi) AS total_harga,
                                        SUM(ts.hm_akhir - ts.hm_awal) AS total_jam_kerja
                                        FROM timesheet ts
                                        JOIN karyawan k ON ts.id_karyawan = k.id_karyawan
                                        WHERE YEAR(tanggal) BETWEEN 2018 AND YEAR(CURDATE())
                                        GROUP BY YEAR(tanggal) desc, MONTH(tanggal) desc, k.nama_karyawan");
            $data['rangkum3'] = $rangkum->result_array();
            $detil = $this->db->query("SELECT
             tanggal,
            u.nama_unit,
            k.nama_karyawan,
            k.premi,
            SUM((ts.hm_akhir - ts.hm_awal) * k.premi) AS total_premi,
            SUM(ts.hm_akhir - ts.hm_awal) AS total_jam_kerja
        FROM
            timesheet ts
        JOIN
            unit u ON ts.id_unit = u.id_unit
        JOIN
            karyawan k ON ts.id_karyawan = k.id_karyawan
        WHERE
            u.perusahaan IS NOT NULL
        GROUP BY
            tanggal, u.nama_unit, k.nama_karyawan, k.premi
        ORDER BY
            tanggal");
            $data['detil'] = $detil->result_array();
            $data['judul'] = "Laporan Premi Bulanan";
            $data['layout'] = "Rangkum/laporan2";
            $this->load->view('template', $data);
        } else {
            session_destroy();
            redirect('login/index');
        }
    }
}
