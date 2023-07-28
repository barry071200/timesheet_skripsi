<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="<?= base_url('assets/path_to_sweetalert/sweetalert2.min.css') ?>">
<script src="<?= base_url('assets/path_to_sweetalert/sweetalert2.min.js') ?>"></script>

<html>

<head>
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
</head>

<body>
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
            // Dapatkan tombol Save
            var saveButton = document.querySelector('.btn-save');

            // Tambahkan event listener pada tombol Save
            saveButton.addEventListener('click', function(event) {
                event.preventDefault(); // Menghentikan aksi default dari tombol Save

                // Tampilkan konfirmasi Sweet Alert untuk update data
                Swal.fire({
                    title: "Konfirmasi",
                    text: "Apakah Anda yakin ingin mengubah username dan password?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Ubah!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after the update confirmation
                        document.getElementById('updateForm').submit();
                    }
                });
            });
        });
    </script>


    <div class="container container-sm">
        <div class="card card-body">
            <h1 style="text-align: center;">UBAH USERNAME & PASSWORD</h1>
            <br>
            <?php echo validation_errors(); ?>
            <form id="updateForm" method="post" action="<?php echo site_url("user/update") ?>">
                <div class="form-group row">
                    <label for="nama_karyawan" class="col-sm-2 col-form-label">Username :</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control" name="username" value="<?php echo $user['username']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Password :</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" value="" class="form-control" placeholder="Masukan Password baru">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-2">
                        <button class="btn btn-primary btn-save" type="button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





</body>