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

    <form>
        <th colspan="4"><a class="btn btn-primary" data-toggle="modal" data-target="#tambahuser" href="<?php echo site_url('pengguna/tambah') ?>"><i class="fa fa-plus"></i> Tambah</a></th>
    </form>
    <br>

    <table id="example1" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($user as $dt) : ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dt['username']; ?></td>
                    <td><?php echo $dt['password']; ?></td>
                    <td>
                        <?php
                        $role = $dt['role'];
                        if ($role == '1') {
                            echo 'Super Admin';
                        } elseif ($role == '2') {
                            echo 'Manager';
                        } elseif ($role == '3') {
                            echo 'Supervisor';
                        } elseif ($role == '4') {
                            echo 'HR';
                        } elseif ($role == '5') {
                            echo 'Admin';
                        } else {
                            echo 'Role tidak valid';
                        }
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-warning" data-toggle="modal" data-target="#ubahuser<?php echo $dt['id_user']; ?>">Edit</a>
                        <a class="btn btn-danger btn-delete" href="<?php echo site_url("pengguna/delete") . "/" . $dt['id_user']; ?>">Hapus<span class="glyphicon glyphicon-remove"></span></a>
                    </td>

                </tr>
            <?php endforeach ?>
    </table>
    <!-- sweet alert -->
    <script>
        // Saat halaman dimuat
        window.addEventListener('DOMContentLoaded', function() {
            // Dapatkan tombol hapus
            var deleteButtons = document.querySelectorAll('.btn-delete');

            // Tambahkan event listener pada setiap tombol hapus
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Menghentikan aksi default dari tombol hapus

                    // Tampilkan konfirmasi Sweet Alert
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
                            // Arahkan ke aksi penghapusan
                            window.location.href = button.getAttribute('href');
                        }
                    });
                });
            });
        });
    </script>
    <!-- sweet alert -->
    <div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form method="post" action="<?php echo site_url("pengguna/tambah") ?>">

                            <label for="username">Username</label>
                            <input type="text" required class="form-control" id="username" name="username" placeholder="Masukan Username">
                            <label for="password">Password</label>
                            <textarea required class="form-control" rows="3" id="password" name="password" placeholder="Masukan Password"></textarea>
                            <label for="role">Role</label>
                            <select required class="form-control" id="role" name="role">
                                <option value="1">Super Admin</option>
                                <option value="2">Manager</option>
                                <option value="3">Supervisor</option>
                                <option value="4">HR</option>
                                <option value="5">Admin</option>

                            </select>
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
    <?php $no = 0;
    foreach ($user as $dt) : $no++ ?>
        <div class="modal fade" id="ubahuser<?php echo $dt['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data user</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form method="post" action="<?php echo site_url("pengguna/edit"); ?>">
                                <label for="id_user">ID user</label>
                                <input type="text" required class="form-control" id="id_user" name="id_user" value="<?php echo $dt['id_user']; ?>" readonly>
                                <label for="username">Username</label>
                                <input type="text" required class="form-control" id="username" name="username" value="<?php echo $dt['username']; ?>">
                                <label for="password">Password</label>
                                <input type="text" required class="form-control" id="password" name="password" value="<?php echo $dt['password']; ?>">
                                <label for="role">Role</label>
                                <select required class="form-control" id="role" name="role">
                                    <option value="1" <?php if ($dt['role'] == '1') echo 'selected'; ?>>Super Admin</option>
                                    <option value="2" <?php if ($dt['role'] == '2') echo 'selected'; ?>>Manager</option>
                                    <option value="3" <?php if ($dt['role'] == '3') echo 'selected'; ?>>Supervisor</option>
                                    <option value="4" <?php if ($dt['role'] == '4') echo 'selected'; ?>>HR</option>
                                    <option value="5" <?php if ($dt['role'] == '5') echo 'selected'; ?>>Admin</option>
                                </select>
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
    <?php endforeach ?>
</div>
<script>
    var table = $('#example1').DataTable();

    new $.fn.dataTable.Buttons(table, {
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });

    table.buttons().container()
        .appendTo($('.col-sm-6:eq(0)', table.table().container()));
</script>