<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url() ?>assets/DataTables/DataTables.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/DataTables/DataTables.min.css">

<div class="card-body">
    <div class="form-row">
        <div class="form-row">
            <div class="col-md-3" style="display: flex; align-items: center;">
                <label for="bulan" style="margin-right: 10px;">Bulan:</label>
                <select id="bulan" class="form-control" style="width: 200px;">
                    <option value="">Semua Bulan</option>
                    <option value="January">Januari</option>
                    <option value="February">Februari</option>
                    <option value="March">Maret</option>
                    <option value="April">April</option>
                    <option value="May">Mei</option>
                    <option value="June">Juni</option>
                    <option value="July">Juli</option>
                    <option value="August">Agustus</option>
                    <option value="September">September</option>
                    <option value="October">Oktober</option>
                    <option value="November">November</option>
                    <option value="December">Desember</option>
                </select>
            </div>
            <div class="col-md-3" style="display: flex; align-items: center;">
                <label for="tahun" style="margin-right: 10px; margin-left : 20px;">Tahun:</label>
                <select id="tahun" class="form-control" style="width: 200px;">
                    <option value="">Semua Tahun</option>
                    <?php for ($i = 2018; $i <= 2025; $i++) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-3" style="display: flex; align-items: center;">
                <button type="button" onclick="filterData()" class="btn btn-primary" style="margin-left: 30px;">Filter</button>
                <button type="button" onclick="resetFilter()" class="btn btn-secondary" style="margin-left: 10px;">Reset</button>
                <button type="button" onclick="printData()" style="margin-left: 10px;" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                    </svg>
                    Print
                </button>
            </div>
        </div>
    </div>
    <br>
    <table id="example1" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>Tahun</th>
                <th>Bulan</th>
                <th>Nama Karyawan</th>
                <th>Jam Kerja</th>
                <th class="text-center" style="width: 12.5%;">Total Biaya Premi</th>
                <th class="opsi-column text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($rangkum3 as $dt) : ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dt['tahun']; ?></td>
                    <td><?php echo $dt['bulan']; ?></td>
                    <td><?php echo $dt['nama_karyawan']; ?></td>
                    <td><?php echo $dt['total_jam_kerja']; ?> Jam</td>
                    <td>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-right : 30px;">
                            <div style="text-align: right;">
                                Rp
                            </div>
                            <div style="text-align: right;">
                                <?php echo number_format($dt['total_harga'], 0, ',', '.'); ?>
                            </div>
                        </div>
                    </td>
                    <td class="opsi-column text-center align-middle">
                        <?php
                        $target = "#detil-" . str_replace(' ', '_', $dt['tahun']) . '-' . str_replace(' ', '_', $dt['bulan']) . '-' . str_replace(' ', '_', $dt['nama_karyawan']);
                        ?>
                        <button class="btn btn-info btn-icon" data-toggle="modal" data-target="<?php echo $target; ?>">Detail</button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <?php
    $no = 1;
    foreach ($rangkum3 as $dt) :
        $id = "detil-" . str_replace(' ', '_', $dt['tahun']) . '-' . str_replace(' ', '_', $dt['bulan']) . '-' . str_replace(' ', '_', $dt['nama_karyawan']);
        //var_dump($id);
    ?>
        <div class="modal fade modal-custom" id="<?php echo $id; ?>" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <?php
                        $nama_karyawan = str_replace('_', ' ', $dt['nama_karyawan']);
                        ?>
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Sewa - <?php echo $nama_karyawan . ' ' . $dt['bulan'] . ' ' . $dt['tahun']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="modalTable-<?php echo str_replace(' ', '_', $dt['tahun']) . '-' . str_replace(' ', '_', $dt['bulan']); ?>" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Tahun</th>
                                    <th>Nama Karyawan</th>
                                    <th>Nama Unit</th>
                                    <th>Jam Kerja</th>
                                    <th>Premi</th>
                                    <th>Total Biaya Premi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no2 = 1;
                                $totalJamKerja = 0;
                                $totalPremi = 0;
                                foreach ($detil as $d) :
                                    $detil_nama_karyawan = str_replace('_', ' ', $d['nama_karyawan']);
                                    $detil_bulan = date('F', strtotime($d['tanggal']));
                                    $detil_tahun = date('Y', strtotime($d['tanggal']));
                                    if ($detil_bulan === $dt['bulan'] && $detil_tahun === $dt['tahun'] && $detil_nama_karyawan === $dt['nama_karyawan']) :
                                        $totalJamKerja += $d['total_jam_kerja'];
                                        $totalPremi += $d['total_premi'];
                                ?>
                                        <tr>
                                            <td><?php echo $no2++; ?></td>
                                            <td><?php echo $d['tanggal']; ?></td>
                                            <td><?php echo $detil_nama_karyawan; ?></td>
                                            <td><?php echo $d['nama_unit']; ?></td>
                                            <td><?php echo $d['total_jam_kerja']; ?> Jam</td>
                                            <td><?php echo $d['premi']; ?></td>
                                            <td>Rp <?php echo number_format($d['total_premi'], 0, ',', '.'); ?></td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>TOTAL :</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo $totalJamKerja; ?> Jam</th>
                                    <th></th>
                                    <th>Rp <?php echo number_format($totalPremi, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" class="close">
                                <span aria-hidden="true"></span>Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<script>
    var table;

    $(document).ready(function() {
        table = $('#example1').DataTable({
            "pageLength": 31
        });
    });

    function filterData() {
        var bulan = document.getElementById('bulan').value;
        var tahun = document.getElementById('tahun').value;

        table.column(2).search(bulan).column(1).search(tahun).draw();
    }

    function resetFilter() {
        document.getElementById('bulan').value = '';
        document.getElementById('tahun').value = '';

        table.column(2).search('').column(1).search('').draw();
    }

    function printData() {
        var table = document.getElementById('example1');
        var totalJamKerja = 0;
        var totalHarga = 0;
        var actionColumn = table.querySelectorAll(".opsi-column");
        for (var i = 0; i < actionColumn.length; i++) {
            actionColumn[i].style.display = "none";
        }

        // Menghitung total jam kerja dan total harga
        for (var i = 1; i < table.rows.length; i++) {
            totalJamKerja += parseFloat(table.rows[i].cells[4].textContent);
            totalHarga += parseInt(table.rows[i].cells[5].textContent.replace(/\D/g, ''));
        }

        var tableData = table.outerHTML;

        var printPreview = document.createElement('div');
        printPreview.innerHTML = '<style>body { font-size: 12px; }</style>' +
            '<div class="d-flex justify-content-between">' +
            '<h1>PT Bumi Barito Minieral</h1>' +
            '<h1 class="text-right">Laporan Biaya Sewa Bulanan</h1>' +
            '</div>' +
            '<table>' + tableData + '</table>' +
            '<div>Total Jam Kerja: ' + totalJamKerja + ' Jam</div>' +
            '<div>Total Pembayaran: Rp ' + totalHarga.toLocaleString() + '</div>';
        document.body.innerHTML = printPreview.innerHTML;
        window.print();
        location.reload();
    }
</script>