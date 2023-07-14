<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<script src="<?= base_url() ?>assets/DataTables/DataTables.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/DataTables/DataTables.min.css">
<div class="card-body">
    <button type="button" onclick="printData()" style="margin-right: 10px;" class="btn btn-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
        </svg>
        Print
    </button>
    <br>
    <br>
    <table id="example1" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>OPERATOR</th>
                <th>UNIT</th>
                <th>TANGGAL</th>
                <th>HM AWAL</th>
                <th>HM AKHIR</th>
                <th>JUMLAH</th>
                <th>KETERANGAN</th>
                <th>CEK</th>
                <th>KONFIRMASI</th>


            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            $valid = "DITERIMA";
            $tValid = "DITOLAK";
            foreach ($timesheet as $dt) : ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dt['nama_karyawan']; ?></td>
                    <td><?php echo $dt['nama_unit']; ?></td>
                    <td><?php echo $dt['tanggal']; ?></td>
                    <td><?php echo $dt['hm_awal']; ?></td>
                    <td><?php echo $dt['hm_akhir']; ?></td>
                    <td><?php echo $dt['hm_akhir'] - $dt['hm_awal']; ?> Jam</td>
                    <td><?php echo $dt['keterangan']; ?></td>
                    <td class="konfirmasi-column">
                        <?php if ($dt['konfirmasi'] === 'DITERIMA') : ?>
                            <span class="badge bg-green">
                                <?php echo $dt['konfirmasi']; ?>
                            </span>
                        <?php elseif ($dt['konfirmasi'] === 'DITOLAK') : ?>
                            <span class="badge bg-warning">
                                <?php echo $dt['konfirmasi']; ?>
                            </span>
                        <?php else : ?>
                            <span class="badge bg-danger">
                                Belum Terkonfirmasi
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="post" action="<?php echo site_url("supervisor/cek") ?>">
                            <a class="btn btn-success" href="<?php echo site_url("supervisor/cek") . "/" . $dt['id_timesheet'] . "/" . $valid; ?>">Diterima</a>
                            <a class="btn btn-warning" href="<?php echo site_url("supervisor/cek") . "/" . $dt['id_timesheet'] . "/" . $tValid; ?>">Ditolak</a>
                        </form>
                    </td>

                </tr>
            <?php endforeach ?>
    </table>
    <div class="modal fade" id="tambahtimesheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Timesheet Baru</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form method="post" action="<?php echo site_url("timesheet/tambah") ?>"> -->

                            <label for="id_unit">ID Unit</label>
                            <input type="text" class="form-control" id="id_unit" name="id_unit" placeholder="Masukan ID Unit">
                            <label for="id_karyawan">ID Karyawan</label>
                            <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" placeholder="Masukan ID karyawan">
                            <label for="tanggal">Tanggal </label>
                            <input type="date" class="form-control" rows="3" id="tanggal" name="tanggal" placeholder="Masukan Tanggal">
                            <label for="hm_awal">HM AWAL</label>
                            <input type="number" class="form-control" rows="3" id="hm_awal" name="hm_awal" placeholder="Masukan HM AWAL">
                            <label for="hm_akhir">HM AKHIR</label>
                            <input type="number" class="form-control" rows="3" id="hm_akhir" name="hm_akhir" placeholder="Masukan HM AKHIR">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan Keterangan Pekerjaan">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


</div>
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            "pageLength": 25, // Mengatur jumlah entri per halaman menjadi 25
            "columnDefs": [{
                "targets": 9, // Kolom "KONFIRMASI" berada pada indeks 9
                "searchable": false // Mengatur kolom "KONFIRMASI" tidak dapat dicari
            }]
        });
    });
</script>
<script>
    function printData() {
        window.print();
    }

    document.addEventListener("keydown", function(event) {
        if (event.ctrlKey && event.key === "p") {
            printData(); // Memanggil fungsi cetak data
        }
    });
</script>