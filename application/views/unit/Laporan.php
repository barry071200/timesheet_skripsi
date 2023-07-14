<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<script src="<?= base_url() ?>assets/DataTables/DataTables.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/DataTables/DataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<div class="card-body">
    <div style="display: flex; align-items: center;">
        <button type="button" onclick="printData()" style="margin-right: 10px;" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
            </svg>
            Print
        </button>
        <label for="daterange" style="margin-right: 10px;">Filter tanggal:</label>
        <input type="#date" id="daterange" class="form-control" placeholder="Masukkan tanggal" style="width: 220px;">
    </div>
    <br>


    <table id="example1" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>UNIT</th>
                <th>OPERATOR</th>
                <th>TANGGAL</th>
                <th>HM AWAL</th>
                <th>HM AKHIR</th>
                <th>JUMLAH</th>
                <th>HARGA SEWA</th>
                <th>TOTAL</th>
                <th>KETERANGAN</th>
                <th>KONFIRMASI</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($unit as $dt) : ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dt['nama_unit']; ?></td>
                    <td><?php echo $dt['nama_karyawan']; ?></td>
                    <td><?php echo $dt['tanggal']; ?></td>
                    <td><?php echo $dt['hm_awal']; ?></td>
                    <td><?php echo $dt['hm_akhir']; ?></td>
                    <td class="jam-kerja"><?php echo $dt['hm_akhir'] - $dt['hm_awal']; ?></td>
                    <td>Rp <?php echo number_format($dt['harga'], 0, ',', '.'); ?></td>
                    <td class="total-sewa">Rp <?php echo number_format($dt['harga'] * ($dt['hm_akhir'] - $dt['hm_awal']), 0, ',', '.'); ?></td>
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
                </tr>
            <?php endforeach ?>
        <tfoot>
            <?php
            foreach ($sum as $dt) : ?>
                <tr>
                    <th colspan="2">TOTAL HARGA SEWA</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>:</th>
                    <th>Rp </th>
                    <th></th>
                    <th></th>
                </tr>
            <?php endforeach ?>
        </tfoot>
    </table>

</div>
<script>
    var table = $('#example1').DataTable({
        "pageLength": 32 // Mengatur jumlah entri per halaman menjadi 25
    });
</script>
<script>
    $(function() {
        $('#daterange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            table.draw();
        });
        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            table.draw();
        });
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = moment($('#daterange').val().split(' - ')[0], 'YYYY-MM-DD');
                var max = moment($('#daterange').val().split(' - ')[1], 'YYYY-MM-DD');
                var date = moment(data[3], 'YYYY-MM-DD');
                if ($('#daterange').val() === '') {
                    return true;
                }
                if (min <= date && date <= max) {
                    return true;
                }
                return false;
            }
        );
        $('#daterange').keyup(function() {
            table.draw();
        });
        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));
    });
</script>
<script>
    function printData() {
        var table = document.getElementById('example1');
        var actionColumn = table.querySelectorAll(".action-column");
        for (var i = 0; i < actionColumn.length; i++) {
            actionColumn[i].style.display = "none";
        }
        var tableData = table.outerHTML;
        var totalJam = 0;
        var jamFields = table.querySelectorAll('.jam-kerja');
        for (var i = 0; i < jamFields.length; i++) {
            var jamText = jamFields[i].textContent;
            var jam = parseInt(jamText);
            if (!isNaN(jam)) {
                totalJam += jam;
            }
        }
        var tableData = table.outerHTML;
        var totalsewa = 0;
        var totalFields = table.querySelectorAll('.total-sewa');
        for (var i = 0; i < totalFields.length; i++) {
            var totalText = totalFields[i].textContent.replace(/[^0-9]/g, '');
            var total = parseInt(totalText);
            if (!isNaN(total)) {
                totalsewa += total;
            }
        }


        var printPreview = document.createElement('div');
        printPreview.innerHTML = '<style>body { font-size: 12px; }</style>' +
            '<div class="d-flex justify-content-between">' +
            '<h1>PT Bumi Barito Minieral</h1>' +
            '<h1 class="text-right">Timesheet</h1>' +
            '</div>' +
            '<table>' + tableData + '</table>' +
            '<p>Total Jam Kerja: ' + totalJam + ' jam</p>' + '<p>Total Biaya Sewa: Rp ' + totalsewa.toLocaleString() + '</p>';
        document.body.innerHTML = printPreview.innerHTML;
        window.print();
        location.reload();
    }
</script>