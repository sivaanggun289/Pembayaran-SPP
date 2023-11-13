<?php
if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $nama_petugas = $_POST['nama_petugas'];
    $level = $_POST['level'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "INSERT INTO petugas (username,nama_petugas,password,level) VALUES('$username','$nama_petugas','$password','$level')");

    if ($query) {
        echo '<script>alert("Data Berhasil di Tambah");location.href="?page=petugas"</script>';
    }
}

if (isset($_POST['hapus'])) {
    $id_petugas = $_POST['id_petugas'];
    $query = mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$id_petugas'");

    if ($query) {
        echo '<script>alert("Data Berhasil di Hapus");location.href="?page=petugas";</script>';
    }
}

if (isset($_POST['edit-petugas'])) {
    $id_petugas = $_POST['id_petugas'];
    $username = $_POST['username'];
    $nama_petugas = $_POST['nama_petugas'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    if (empty($_POST['password'])) {
        $query = mysqli_query($koneksi, "UPDATE petugas SET username='$username', nama_petugas='$nama_petugas',level='$level' WHERE id_petugas='$id_petugas'");
            if ($query) {
            echo '<script>alert("Data Berhasil di Update");location.href="?page=petugas"</script>';
        }
    }else {
        $query = mysqli_query($koneksi, "UPDATE petugas SET username='$username', nama_petugas='$nama_petugas', password='$password', level='$level' WHERE id_petugas='$id_petugas'");
         if ($query) {
            echo '<script>alert("Data Berhasil di Update");location.href="?page=petugas"</script>';
        }
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

  <h1 class="h3 mb-3" style="text-align: center;">Petugas</h1>

                   <div class="row">
                        <div class="col-12">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahpetugas">
                                      + Tambah Petugas
                                    </button>
                                </div> 
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover" id="petugas">
                                        <thead>
                                            <tr>
                                                 <th>NO <i class="fas fa-sort"></i></th>
                                                 <th>Username <i class="fas fa-user"></i></th>
                                                 <th>Nama Petugas <i class="fas fa-user"></i></th>
                                                 <th>Level <i class="fas fa-star"></i></th>
                                                 <th>Action <i class="fas fa-cogs"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $i = 1;
                                        $query = mysqli_query($koneksi, "SELECT * FROM petugas");
                                        while ($data = mysqli_fetch_array($query)){
                                                ?>
                                            <tr>
                                              <td><?php echo $i++ ?></td>
                                              <td><?php echo $data['username'] ?></td>
                                              <td><?php echo $data['nama_petugas'] ?></td>                                              
                                              <td><?php echo $data['level'] ?></td>                                              
                                              
                                                <td>
                                                    <button data-toggle="modal" data-target="#editpetugas<?php echo $data['id_petugas']; ?>" data-username="<?php echo $data['username']; ?>" data-level="<?php echo $data['admin']; ?> - <?php echo $data['petugas']; ?>" class="btn btn-warning btn-sm edit-petugas"><i class="fas fa-edit"></i></button>
                                                    <button data-toggle="modal" data-target="#hapus<?php echo $data['id_petugas']; ?>" class="btn btn-danger btn-sm hapus-petugas"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>

                                             <div class="modal fade" id="hapus<?php echo $data['id_petugas']; ?>" tabindex="-1" aria-labelledby="HapusLabel" aria-hidden="true">
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
                                                                    <input type="hidden" name="id_petugas" value="<?php echo $data['id_petugas']; ?>">
                                                                    <p>Anda yakin ingin menghapus data petugas ini?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="modal fade" id="editpetugas<?php echo $data['id_petugas']; ?>" tabindex="-1" aria-labelledby="editkelasLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editpetugasLabel">Edit Petugas</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_petugas" value="<?php echo $data['id_petugas']; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Username</label>
                                                                <input type="text" name="username" class="form-control" value="<?php echo $data['username'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Petugas</label>
                                                                <input type="text" name="nama_petugas" class="form-control" value="<?php echo $data['nama_petugas'] ?>" required>
                                                            </div>
                                                             <div class="mb-3">
                                                                    <label class="form-label">Password</label>
                                                                    <input type="password" name="password" class= "form-control">  
                                                                </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Level</label>
                                                                <select name="level" class="form-control">
                                                                    <option value="admin" <?php echo ($data['level'] == 'admin' ? 'selected' : '') ?>>Admin</option>
                                                                    <option value="petugas" <?php echo ($data['level'] == 'petugas' ? 'selected' : '') ?>>Petugas</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary" name="edit-petugas">Simpan Perubahan</button>
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
                </div>
                <script>
                    $(document).ready(function() {
                        $('#petugas').DataTable();
                    })
                </script>

                <div class="modal fade" id="tambahpetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="post">
                          <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                                </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Petugas</label>
                                <input type="text" name="nama_petugas" class="form-control" required>
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>  
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Level</label>
                                <select name="level" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
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
                    