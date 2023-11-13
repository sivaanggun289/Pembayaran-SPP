<?php
if (empty($_SESSION['petugas']['level'])) {
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}
?>

<h1 class="h3 mb-3" style="text-align: center;">Laporan</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NO <i class="fas fa-sort"></i></th>
                            <th>Nama Petugas <i class="fas fa-user"></i></th>
                            <th>Nama Siswa <i class="fas fa-user-graduate"></i></th>
                            <th>Tanggal Bayar <i class="far fa-calendar"></i></th>
                            <th>Bulan Bayar <i class="fas fa-calendar-alt"></i></th>
                            <th>Tahun Dibayar <i class="fas fa-calendar"></i></th>
                            <th>SPP <i class="fas fa-money-bill-wave"></i></th>
                            <th>Jumlah Bayar <i class="fas fa-money-bill"></i></th>
                            <th>Status <i class="fas fa-check-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp");
                    while ($data = mysqli_fetch_array($query)){
                            ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $data['nama_petugas'] ?></td>
                            <td><?php echo $data['nama'] ?></td>                                              
                            <td><?php echo date('d-m-Y', strtotime($data['tgl_bayar'])) ?></td>
                            <td><?php echo $data['bulan_bayar'] ?></td>                                        
                            <td><?php echo $data['tahun_dibayar'] ?></td>                                       
                            <td><?php echo $data['tahun'] ?> - Rp. <?php echo $data['nominal'] ?></td>
                            <td>Rp. <?php echo $data['jumlah_bayar'] ?></td>
                            <td>
                                 <?php
                                 if ($data['nominal'] == $data['jumlah_bayar']) {
                                     echo 'lunas'; 
                                 }else{
                                    echo 'kurang';
                                 }
                                  ?>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editpembayaran<?php echo $data['id_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Data Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                                                 
                                  <form method="post">
                                        <div class="modal-body">
                                         <input type="hidden" name="id_pembayaran" value="<?php echo $data['id_pembayaran']; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Petugas</label>
                                            <input type="text" name="nama_petugas" class="form-control" value="<?php echo $data['nama_petugas']; ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Siswa</label>
                                            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Bayar</label>
                                            <input type="text" name="tgl_bayar" class="form-control" value="<?php echo $data['tgl_bayar']; ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Bulan Bayar</label>
                                            <input type="text" name="bulan_bayar" class="form-control" value="<?php echo $data['bulan_bayar']; ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tahun Dibayar</label>
                                            <input type="text" name="tahun_dibayar" class="form-control" value="<?php echo $data['tahun_dibayar']; ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tahun Dan Nominal</label>
                                            <input type="text" name="id_spp" class="form-control" value="<?php echo $data['tahun']; ?> - Rp. <?php echo $data['nominal']; ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah Bayar</label>
                                            <input type="text" name="jumlah_bayar" class="form-control" value="<?php echo $data['jumlah_bayar']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary" name="editpembayaran">Simpan</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                                      
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                   if(!empty($_SESSION['petugas']['level'] == 'admin')){
                   ?>
               <div class="container" style="text-align: center;">
                    <a href="cetak_pembayaran.php"class="btn btn-success btn-sm" target="_blank"><i class="fa fa-print"></i></a>
                </div>
                <?php
                   }
                   ?>
            </div>
        </div>
    </div>
</div>
 <script>
$(document).ready(function() {
    $('#laporan').DataTable();
})
</script>
                    