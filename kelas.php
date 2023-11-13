<?php
if (isset($_POST['simpan'])) {
$nama_kelas = $_POST['nama_kelas'];
$jurusan = $_POST['jurusan'];

$query = mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas,jurusan) VALUES('$nama_kelas','$jurusan')");

if ($query) {
    echo '<script>alert("Data Berhasil di Tambah");location.href="?page=kelas"</script>';
 }
}

if (isset($_POST['hapus'])) {
    $Id_kelas = $_POST['Id_kelas'];
    $query = mysqli_query($koneksi, "DELETE FROM kelas WHERE Id_kelas='$Id_kelas'");

    if ($query) {
        echo '<script>alert("Data Berhasil di Hapus");location.href="?page=kelas";</script>';
    }
}

if (isset($_POST['editkelas'])) {
    $Id_kelas = $_POST['Id_kelas'];
$nama_kelas = $_POST['nama_kelas'];
$jurusan = $_POST['jurusan'];

    $query = mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama_kelas', jurusan='$jurusan' WHERE Id_kelas='$Id_kelas'");

    if ($query) {
        echo '<script>alert("Data Berhasil di Update");location.href="?page=kelas"</script>';
    }
}

if (empty($_SESSION['petugas']['level']) || empty($_SESSION['petugas']['level'] == 'admin')) {
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}

?>
   <h1 class="h3 mb-3" style="text-align: center;">Kelas</h1>

                  <div class="row">
                        <div class="col-12">
                            <div class="card flex-fill">
                                <div class="card-header">
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahkelas">
                                      + Tambah Kelas
                                  </button>
                                </div> 
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover" id="kelas">
                                        <thead>
                                            <tr>
                                                <th>NO <i class="fa fa-sort"></i></th>
                                                <th><i class="fas fa-book"></i> Nama Kelas</th>
                                                <th><i class="fas fa-user-graduate"></i> Jurusan</th>
                                                <th><i class="fas fa-cogs"></i> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
                                        $i = 1;
                                        $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                        while ($data = mysqli_fetch_array($query)){
                                                ?>
                                            <tr>
                                              <td><?php echo $i++ ?></td>
                                              <td><?php echo $data['nama_kelas'] ?></td>
                                              <td><?php echo $data['jurusan'] ?></td>             
                                                <td>      
                                                    <button data-toggle="modal" data-target="#editkelas<?php echo $data['Id_kelas']; ?>" data-nama="<?php echo $data['nama_kelas']; ?>" data-jurusan="<?php echo $data['jurusan']; ?>" class="btn btn-warning btn-sm edit-kelas"><i class="fas fa-edit"></i></button>
                                                    <button data-toggle="modal" data-target="#hapus<?php echo $data['Id_kelas']; ?>" class="btn btn-danger btn-sm hapus-kelas"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>

                                               <div class="modal fade" id="hapus<?php echo $data['Id_kelas']; ?>" tabindex="-1" aria-labelledby="HapusLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="HapusLabel">Konfirmasi Hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="Id_kelas" value="<?php echo $data['Id_kelas']; ?>">
                                                                    <p>Anda yakin ingin menghapus kelas ini?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                     <!-- Tambahkan kode modal untuk edit kelas -->
                                        <div class="modal fade" id="editkelas<?php echo $data['Id_kelas']; ?>" tabindex="-1" aria-labelledby="editkelasLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editkelasLabel">Edit Kelas</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="Id_kelas" value="<?php echo $data['Id_kelas']; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Kelas</label>
                                                                <input type="text" name="nama_kelas" class="form-control" value="<?php echo $data['nama_kelas'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Jurusan</label>
                                                                <input type="text" name="jurusan" class="form-control" value="<?php echo $data['jurusan'] ?>" required>
                                                            </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary" name="editkelas">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                                     <?php
                                                    }
                                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                     <script>
                    $(document).ready(function() {
                        $('#kelas').DataTable();
                    })
                </script>
                    <div class="modal fade" id="tambahkelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="post">
                            <div class="modal-body">
                             <div class="mb-3">
                                <label class="form-label">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" class="form-control" required>
                                </div>
                            <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" required>
                            </div>
                            </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                              </div>
                           </form>
                        </div>
                      </div>
                    </div>

                