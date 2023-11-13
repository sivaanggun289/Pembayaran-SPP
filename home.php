<?php
      if(!empty($_SESSION['petugas']['level'] )){
        ?>

        
                    <h1 class="h3 mb-3" style="text-align: center;">Aplikasi Pembayaran SPP</h1>
                    <br>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                                Jumlah Petugas</div>
                                            <div class="h5 mb-0 font-weight-bold text-white-800">21</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-white-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                                Jumlah Kelas
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-white-800">10</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-white-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                           <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                                Jumlah Siswa Perempuan</div>
                                            <div class="h5 mb-0 font-weight-bold text-white-800">30</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-white-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="col-xl-3 col-md-6 mb-4">
                             <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Siswa Laki-Laki
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-white-800">37</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas  fa fa-plus-square fa-2x text-white-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
     <?php
      }else{
        ?>
            <h1 class="h3 mb-3" style="text-align: center;">History Siswa</h1>

                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Petugas</th>
                                        <th>Nama Siswa</th> 
                                        <th>Tanggal Bayar</th>
                                        <th>Bulan Bayar</th>
                                        <th>Tahun Dibayar</th>
                                        <th>SPP</th>
                                        <th>Jumlah Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $id = $_SESSION['petugas']['nisn'];
                                $i = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp WHERE pembayaran.nisn='$id'");

                            

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
                                            <input type="date" name="tgl_bayar" class="form-control" value="<?php echo $data['tgl_bayar']; ?>" disabled>
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
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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
              }
          ?>