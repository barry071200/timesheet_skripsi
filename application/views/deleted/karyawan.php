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
    <div style="display: flex; align-items: center;">
        <br>
    </div>
    <table id="example1" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>nama</th>
                <th>Alamat</th>
                <th>No Telpon</th>
                <th>Tanggal Lahir</th>
                <th>jenis kelamin</th>
                <th class="text-center" style="width: 10%;">Premi</th>
                <th>Tanggal terhapus</th>
                <?php if ($this->session->userdata('role') == '1') { ?><th class="action-column text-center align-middle">Action</th><?php } ?>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($deleted_karyawan as $dt) : ?>
                <tr>
                    <td class="action-column"><?php echo $no++; ?></td>
                    <td><?php echo $dt['nama_karyawan']; ?></td>
                    <td><?php echo $dt['alamat']; ?></td>
                    <td><?php echo $dt['no_telpon']; ?></td>
                    <td><?php echo $dt['tgl_lahir']; ?></td>
                    <td><?php echo $dt['jenis_kelamin']; ?></td>
                    <td>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="margin-left: 0px;">
                                Rp
                            </div>
                            <div style="text-align: right; margin-right: 30px">
                                <?php echo number_format($dt['premi'], 0, ',', '.'); ?>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $dt['deleted_at']; ?></td>
                    <?php if ($this->session->userdata('role') == '1') { ?>
                        <td class="action-column text-center align-middle">
                            <a class="btn btn-warning" data-toggle="modal" data-target="#ubahkaryawan<?php echo $dt['nama_karyawan']; ?>">Restore</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php endforeach ?>
    </table>
</div>
<script>
    var table = $('#example1').DataTable({
        "pageLength": 25
    });
</script>