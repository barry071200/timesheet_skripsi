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
    <table id="example1" class="table table-striped table-condensed">
        <thead class="table-dark">
            <tr>
                <th class="text-left">NO</th>
                <th class="text-left">Tahun</th>
                <th class="text-left">Bulan</th>
                <th class="text-left">Perusahaan</th>
                <th class="text-left">Jam Kerja</th>
                <th class="text-center" style="width: 13%;">Total Biaya Sewa</th>
                <th class="text-center opsi-column">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($sewa as $dt) : ?>
                <tr>
                    <td class="opsi-column"><?php echo $no++; ?></td>
                    <td><?php echo $dt['tahun']; ?></td>
                    <td><?php echo $dt['bulan']; ?></td>
                    <td><?php echo $dt['perusahaan']; ?></td>
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
                        $target = "#detil-" . str_replace(' ', '_', $dt['tahun']) . '-' . str_replace(' ', '_', $dt['bulan']) . '-' . str_replace(' ', '_', $dt['perusahaan']);
                        ?>
                        <button class="btn btn-info btn-icon" data-toggle="modal" data-target="<?php echo $target; ?>">Detail</button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <?php
    $no = 1;
    foreach ($sewa as $dt) : ?>
        <?php
        $id = "detil-" . str_replace(' ', '_', $dt['tahun']) . '-' . str_replace(' ', '_', $dt['bulan']) . '-' . str_replace(' ', '_', $dt['perusahaan']);
        // var_dump($id);
        ?>
        <div class="modal fade modal-custom" id="<?php echo $id; ?>" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <?php
                        $perusahaan = str_replace('_', ' ', $dt['perusahaan']);
                        ?>
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Sewa - <?php echo $perusahaan . ' ' . $dt['bulan'] . ' ' . $dt['tahun']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" <?php echo str_replace(' ', '_', $dt['tahun']) . '-' . str_replace(' ', '_', $dt['bulan']); ?>>
                        <table id="modalTable-" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Bulan</th>
                                    <th>Nama Unit</th>
                                    <th>Perusahaan</th>
                                    <th>Harga</th>
                                    <th>Total Jam Kerja</th>
                                    <th>Total Harga Sewa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no2 = 1;
                                $totalJamKerja = 0;
                                $totalHargaSewa = 0;
                                foreach ($detil as $d) : ?>
                                    <?php
                                    $detil_perusahaan = str_replace('_', ' ', $d['perusahaan']);
                                    ?>
                                    <?php if (str_replace(' ', '_', $d['bulan']) === str_replace(' ', '_', $dt['bulan']) && str_replace(' ', '_', $d['tahun']) === str_replace(' ', '_', $dt['tahun']) && str_replace(' ', '_', $d['perusahaan']) === str_replace(' ', '_', $dt['perusahaan'])) : ?>
                                        <tr>
                                            <td><?php echo $no2++; ?></td>
                                            <td><?php echo $d['tahun']; ?></td>
                                            <td><?php echo $d['bulan']; ?></td>
                                            <td><?php echo $d['nama_unit']; ?></td>
                                            <td><?php echo $detil_perusahaan; ?></td>
                                            <td><?php echo $d['harga']; ?></td>
                                            <td><?php echo $d['total_jam_kerja']; ?> Jam</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-between; align-items: center; margin-right : 30px;">
                                                    <div style="text-align: right;">
                                                        Rp
                                                    </div>
                                                    <div style="text-align: right;">
                                                        <?php echo number_format($d['total_harga_sewa'], 0, ',', '.'); ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $totalJamKerja += $d['total_jam_kerja'];
                                        $totalHargaSewa += $d['total_harga_sewa'];
                                        ?>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>TOTAL :</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo $totalJamKerja; ?> Jam</th>
                                    <th>
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-right : 30px;">
                                            <div style="text-align: right;">
                                                Rp
                                            </div>
                                            <div style="text-align: right;">
                                                <?php echo number_format($totalHargaSewa, 0, ',', '.'); ?>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" class="close">
                            <span aria-hidden="true"></span>Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    endforeach ?>
</div>






<script>
    var table;

    $(document).ready(function() {
        table = $('#example1').DataTable();
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
        var rows = table.rows;
        for (var i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
            var row = rows[i];
            var noCell = document.createElement('td');
            noCell.textContent = i; // Number starts from 1
            row.insertBefore(noCell, row.firstElementChild);
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
            '<div><th></th>Total Pembayaran: Rp ' + totalHarga.toLocaleString() + '</th></div>';
        document.body.innerHTML = printPreview.innerHTML;
        window.print();
        location.reload();
    }
</script>

<style>
    .modal-custom {
        width: 100%;
        max-width: 2400px;
    }
</style>