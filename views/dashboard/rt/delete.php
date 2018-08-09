<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">description</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Hapus RT -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <?php  
                            $rt_id = $_GET['id']; 

                            $query2 = "SELECT rt.id AS rtID, rw.id AS rwID, rw.nama_rw, rt.nama_rt, rt.ketua_rt FROM rw, rt WHERE rw.id = rt.rw_id AND rt.id = '$rt_id'";
                            $procs2 = mysqli_query($conn, $query2);
                            $data = mysqli_fetch_assoc($procs2);
                        ?>
                        <p>Apakah anda yakin ingin menghapus data berikut ini :</p>
                        <form action="cores/dashboard/rt/delete-rt-process.php" method="post" accept-charset="utf-8">
                            <input type="hidden" name="rt_id" id="rt_id" value="<?php echo $data['rtID'] ?>">
                            <div class="form-group">
                                <label class="control-label" for="rw_id">Nama RW</label>
                                <select class="selectpicker readonly" data-style="select-with-transition" title="Pilih RW" id="rw_id" name="rw_id">
                                    <option value="<?php echo $data['rwID'] ?>" selected>RW <?php echo $data['nama_rw'] ?></option>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="nama">Nama RT</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_rt'] ?>" readonly>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="ketua">Nama Ketua RT</label>
                                <input type="text" class="form-control" name="ketua" id="ketua" value="<?php echo $data['ketua_rt'] ?>" readonly>
                            </div><br>
                            <a href="?page=kelola-rt" class="btn btn-default"><i class="material-icons">table_chart</i></a>
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