<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<script src="<?= base_url() ?>assets/DataTables/DataTables.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/DataTables/DataTables.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="<?= base_url('assets/path_to_sweetalert/sweetalert2.min.css') ?>">
<script src="<?= base_url('assets/path_to_sweetalert/sweetalert2.min.js') ?>"></script>

<div class="card-body">
    <?php
    if (!empty($this->session->flashdata('admin_save_success'))) {
        echo '
    <script>
        Swal.fire({
            icon: "success",
            title: "Sukses",
            text: "' . $this->session->flashdata('admin_save_success') . '",
            showConfirmButton: false,
            timer: 3000
        });
    </script>';
    }
    ?>


    <?php if ($this->session->flashdata('admin_save_success')) : ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('admin_save_success'); ?>
        </div>
        <script>
            setTimeout(function() {
                $(".alert").slideUp("slow", function() {
                    $(this).remove();
                });
            }, 3000);
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('admin_hapus_success')) : ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('admin_hapus_success'); ?>
        </div>
        <script>
            setTimeout(function() {
                $(".alert").slideUp("slow", function() {
                    $(this).remove();
                });
            }, 3000);
        </script>
    <?php endif; ?>


    <script>
        window.addEventListener('DOMContentLoaded', function() {
            fetch('<?php echo base_url('timesheet/clear_flash_data'); ?>', {
                method: 'POST'
            });
        });
    </script>
    <div style="display: flex; align-items: center;">
        <?php if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '4') { ?>
            <form>
                <th colspan="4"><a class="btn btn-primary" data-toggle="modal" style="margin-right: 10px;" data-target="#tambahunit" href="<?php echo site_url('unit/tambah') ?>"><i class="fa fa-plus"></i> Tambah</a></th>
            </form>
        <?php } ?>
        <br>
        <button type="button" onclick="printData()" style="margin-right: 10px;" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
            </svg>
            Print
        </button>
        <br>

    </div>
    <br>
    <table id="example1" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>Nama Unit</th>
                <th>Perusahaan</th>
                <th>Tahun</th>
                <th class="text-center" style="width: 10%;">Harga/Jam</th>
                <?php if ($this->session->userdata('role') == '4' or $this->session->userdata('role') == '1') { ?><th class="action-column text-center">Action</th><?php } ?>
                <?php if ($this->session->userdata('role') != '4') { ?><th class="sheet-column text-center">TIMESHEET</th><?php } ?>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($unit as $dt) : ?>
                <tr>
                    <td class="action-column"><?php echo $no++; ?></td>
                    <td><?php echo $dt['nama_unit']; ?></td>
                    <td><?php echo $dt['perusahaan']; ?></td>
                    <td><?php echo $dt['tahun']; ?></td>
                    <td>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="text-align: left;">
                                Rp
                            </div>
                            <div style="text-align: right; margin-right: 15px">
                                <?php echo number_format($dt['harga'], 0, ',', '.'); ?>
                            </div>
                        </div>
                    </td>
                    <?php if ($this->session->userdata('role') == '4' or $this->session->userdata('role') == '1') { ?>
                        <td class="action-column text-center align-middle">
                            <a class="btn btn-warning" data-toggle="modal" data-target="#ubahunit<?php echo $dt['id_unit']; ?>">Edit</a>
                            <a class="btn btn-danger btn-delete" href="<?php echo site_url("unit/delete") . "/" . $dt['id_unit']; ?>">Hapus<span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                    <?php } ?>
                    <?php if ($this->session->userdata('role') != '4') { ?>
                        <td class="sheet-column text-center align-middle"> <a class="btn btn-success" href="<?php echo site_url("unit/sheet") . "/" . $dt['id_unit']; ?>">SHEET</a></td>
                    <?php } ?>
                </tr>
            <?php endforeach ?>

    </table>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Konfirmasi",
                        text: "Apakah Anda yakin ingin menghapus?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Hapus",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = button.getAttribute('href');
                        }
                    });
                });
            });
        });
    </script>
    <div class="modal fade" id="tambahunit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Unit Baru</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form method="post" action="<?php echo site_url("unit/tambah") ?>">
                            <label for="nama_unit">Nama Unit</label>
                            <input type="text" required class="form-control" id="nama_unit" name="nama_unit" placeholder="Masukan Nama Unit" onchange="checkDuplicateName()">
                            <label for="perusahaan">Perusahaan</label>
                            <input type="text" required class="form-control" id="perusahaan" name="perusahaan" placeholder="Masukan Nama Perusahaan">
                            <label for="tahun">Tahun</label>
                            <input type="text" required class="form-control" id="tahun" name="tahun" placeholder="Masukan Tahun Pembelian (4 karakter)" maxlength="4">
                            <label for="harga">Harga/Jam</label>
                            <input type="number" required class="form-control" id="harga" name="harga" placeholder="Masukan Harga Sewa Unit Per jam">
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

    <script>
        var tahunInputTambah = document.getElementById('tahun');
        tahunInputTambah.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 4);
        });
    </script>


    <?php $no = 0;
    foreach ($unit as $dt) : $no++ ?>
        <div class="modal fade" id="ubahunit<?php echo $dt['id_unit']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Unit</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form method="post" action="<?php echo site_url("unit/edit") ?>">
                                <label for="id_unit">ID Unit</label>
                                <input type="text" required class="form-control" id="id_unit" name="id_unit" value="<?php echo $dt['id_unit']; ?>" readonly>
                                <label for="nama_unit">Nama Unit</label>
                                <input type="text" required class="form-control" id="nama_unit" name="nama_unit" value="<?php echo $dt['nama_unit']; ?>" onchange="checkDuplicateName()">
                                <label for="perusahaan">Perusahaan</label>
                                <input type="text" required class="form-control" id="perusahaan" name="perusahaan" value="<?php echo $dt['perusahaan']; ?>">
                                <label for="tahun">Tahun</label>
                                <input type="text" required class="form-control" id="tahun-<?php echo $dt['id_unit']; ?>" name="tahun" placeholder="Masukan Tahun Pembelian (4 karakter)" value="<?php echo $dt['tahun']; ?>">
                                <label for="harga">Harga/Jam</label>
                                <input type="number" required class="form-control" id="harga" name="harga" value="<?php echo $dt['harga']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                    <script>
                        var tahunInputUbah<?php echo $dt['id_unit']; ?> = document.getElementById('tahun-<?php echo $dt['id_unit']; ?>');
                        tahunInputUbah<?php echo $dt['id_unit']; ?>.addEventListener('input', function() {
                            this.value = this.value.replace(/\D/g, '').slice(0, 4);
                        });
                    </script>
                </div>
            </div>
        </div>
    <?php endforeach ?>


</div>
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
<script>
    function checkDuplicateName() {
        var nameInput = document.getElementById("nama_unit").value;
        var existingNames = <?php echo json_encode(array_column($unit, 'nama_unit')); ?>;

        if (existingNames.includes(nameInput)) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nama Unit sudah terdaptar dalam sistem ganti dengan nama lain!!!',
            });
            document.getElementById("nama_unit").value = "";
        }

    }
</script>
<script>
    function printData() {
        var table = document.getElementById('example1');
        var actionColumn = table.querySelectorAll(".action-column");
        for (var i = 0; i < actionColumn.length; i++) {
            actionColumn[i].style.display = "none";
        }
        var actionColumn = table.querySelectorAll(".sheet-column");
        for (var i = 0; i < actionColumn.length; i++) {
            actionColumn[i].style.display = "none";
        }
        var rows = table.rows;
        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var noCell = document.createElement('td');
            noCell.textContent = i;
            row.insertBefore(noCell, row.firstElementChild);
        }
        var tableData = table.outerHTML;


        var printPreview = document.createElement('div');
        printPreview.innerHTML = '<style>body { font-size: 12px; }</style>' +
            '<div class="d-flex justify-content-between">' +
            '<h1>PT Bumi Barito Minieral</h1>' +
            '<h1 class="text-right">Daftar Unit</h1>' +
            '</div>' +
            '<table>' + tableData + '</table>';
        document.body.innerHTML = printPreview.innerHTML;
        window.print();
        location.reload();
    }
</script>