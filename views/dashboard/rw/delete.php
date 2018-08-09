<?php  

    $rw_id = $_GET['id'];
    $query = "SELECT * FROM rw WHERE id = '$rw_id'";
    $procs = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($procs);

?>

<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">description</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Hapus RW -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Apakah anda yakin ingin menghapus data berikut?</p><br>
                        <form action="cores/dashboard/rw/delete-rw-process.php" method="post" accept-charset="utf-8">
                            <input type="hidden" name="rw_id" id="rw_id" value="<?php echo $rw_id ?>">
                            <div class="form-group label-floating">
                                <label class="control-label" for="nama">Nama RW</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_rw'] ?>" readonly>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="ketua">Nama Ketua RW</label>
                                <input type="text" class="form-control" name="ketua" id="ketua" value="<?php echo $data['ketua_rw'] ?>" readonly>
                            </div><br>
                            <a href="?page=kelola-rw" class="btn btn-default"><i class="material-icons">table_chart</i></a>
                            <button type="submit" class="btn btn-fill btn-danger pull-right">
                                <i class="material-icons">delete</i> 
                                HAPUS
                            </button>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php include 'views/partials/rightbar.php'; ?>
    </div>
</div>