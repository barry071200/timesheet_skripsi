<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
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
                <th>Jam Kerja</th>
                <th>Biaya Sewa Bulanan</th>
                <th>Biaya Premi Bulanan</th>
                <th>Total Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($rangkum as $dt) : ?>
                <tr>
                    <td class="action-column"><?php echo $no++; ?></td>
                    <td><?php echo $dt['tahun']; ?></td>
                    <td><?php echo $dt['bulan']; ?></td>
                    <td><?php echo $dt['total_jam_kerja']; ?> Jam</td>
                    <td>Rp <?php echo number_format($dt['total_harga'], 0, ',', '.'); ?></td>
                    <td>Rp <?php echo number_format($dt['total_premi'], 0, ',', '.'); ?></td>
                    <td>Rp <?php echo number_format($dt['total_premi'] + $dt['total_harga'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<script>
    var table = $('#example1').DataTable({
        "pageLength": 31
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
        var totalSewa = 0;
        var totalPremi = 0;
        var totalPengeluaran = 0;

        var actionColumn = table.querySelectorAll(".action-column");
        for (var i = 0; i < actionColumn.length; i++) {
            actionColumn[i].style.display = "none";
        }

        for (var i = 1; i < table.rows.length; i++) {
            totalJamKerja += parseFloat(table.rows[i].cells[3].textContent);
            totalSewa += parseInt(table.rows[i].cells[4].textContent.replace(/\D/g, ''));
            totalPremi += parseFloat(table.rows[i].cells[5].textContent.replace(/\D/g, ''));
            totalPengeluaran += parseFloat(table.rows[i].cells[6].textContent.replace(/\D/g, ''));
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
            '<div>Total Sewa: Rp ' + totalSewa.toLocaleString() + '</div>' +
            '<div>Total Premi: Rp ' + totalPremi.toLocaleString() + '</div>' +
            '<div>Total Pengeluaran: Rp ' + totalPengeluaran.toLocaleString() + '</div>';
        document.body.innerHTML = printPreview.innerHTML;
        window.print();
        location.reload();
    }
</script>