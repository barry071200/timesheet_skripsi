                <div class="card-body">
                  <form>
                    <th colspan="4"><a class="btn btn-primary">Tambah Karyawan</a></th>
                  </form>
                  <br>

                  <table id="example1" class="table table-striped">
                    <thead>
                      <tr>
                        <th>nama</th>
                        <th>Alamat</th>
                        <th>No Telpon</th>
                        <th>ACTION</th>
                        <th>TIMESHEET</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($karyawan as $dt) : ?>
                        <tr>
                          <td><?php echo $dt['nama_karyawan']; ?></td>
                          <td><?php echo $dt['alamat']; ?></td>
                          <td><?php echo $dt['no_telpon']; ?></td>
                          <td>
                            <a class="btn btn-warning" href="<?php echo site_url("dashboard/index") . "/" . $dt['id_karyawan']; ?>">Tambah<span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger" data-href="<?php echo site_url("dashboard/index") . "/" . $dt['id_karyawan']; ?>" data-toggle="modal" data-target="#confirm-delete" href="#">Hapus<span class="glyphicon glyphicon-remove"></span></a>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    <tfoot>
                      <tr>
                        <th>nama</th>
                        <th>Alamat</th>
                        <th>No Telpon</th>
                        <th>ACTION</th>
                        <th>TIMESHEET</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>