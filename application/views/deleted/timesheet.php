<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<script src="<?= base_url() ?>assets/DataTables/DataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/DataTables/DataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="<?= base_url('assets/path_to_sweetalert/sweetalert2.min.css') ?>">
<script src="<?= base_url('assets/path_to_sweetalert/sweetalert2.min.js') ?>"></script>
<div class="card-body">
    <div class="icon-container">

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
    </div>
    <br>
    <table id="example1" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>OPERATOR</th>
                <th>UNIT</th>
                <th>TANGGAL</th>
                <th>Hour Meter AWAL</th>
                <th>Hour Meter AKHIR</th>
                <th>JAM KERJA</th>
                <th>KETERANGAN</th>
                <th>KONFIRMASI</th>
                <th>TANGGAL TERHAPUS</th>
                <th class="action-column">ACTION</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($deleted_timesheet as $dt) : ?>
                <tr>
                    <td class="action-column"><?php echo $no++; ?></td>
                    <td><?php echo $dt['id_karyawan']; ?></td>
                    <td><?php echo $dt['id_unit']; ?></td>
                    <td><?php echo $dt['tanggal']; ?></td>
                    <td><?php echo $dt['hm_awal']; ?></td>
                    <td><?php echo $dt['hm_akhir']; ?></td>
                    <td class="jam-kerja"><?php echo $dt['hm_akhir'] - $dt['hm_awal']; ?></td>
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
                    <td><?php echo $dt['deleted_at']; ?></td>
                    <td class="action-column">
                        <a class="btn btn-warning" href="<?php echo site_url("deleted/restore_timesheet") . "/" . $dt['id']; ?>">Restore</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>


    <!-- sweet alert -->
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

</div>
<script>
    var table = $('#example1').DataTable({
        "pageLength": 31
    });
</script>