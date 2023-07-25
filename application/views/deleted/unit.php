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
        // Saat halaman dimuat
        window.addEventListener('DOMContentLoaded', function() {
            // Menghapus flash data dengan AJAX
            fetch('<?php echo base_url('timesheet/clear_flash_data'); ?>', {
                method: 'POST'
            });
        });
    </script>
    <br>
    <table id="example1" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>Nama Unit</th>
                <th>Perusahaan</th>
                <th>Tahun</th>
                <th class="text-center" style="width: 8%;">Harga/Jam</th>
                <th>Tanggal Terhapus</th>
                <?php if ($this->session->userdata('role') == '1') { ?><th class="action-column text-center">Action</th><?php } ?>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($deleted_unit as $dt) : ?>
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
                    <td><?php echo $dt['deleted_at']; ?></td>
                    <?php if ($this->session->userdata('role') == '1') { ?>
                        <td class="action-column text-center align-middle">
                            <a class="btn btn-warning" data-toggle="modal" data-target="#ubahunit<?php echo $dt['nama_unit']; ?>">Restore</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php endforeach ?>
    </table>
</div>
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
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>