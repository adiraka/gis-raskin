<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">description</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Ubah RT -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <?php  
                            $rt_id = $_GET['id'];
                            $list_data = [];
                            $query = "SELECT * FROM rw";
                            $procs = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($procs)) {
                                $list_data[] = $row;
                            }

                            $query2 = "SELECT rt.id AS rtID, rw.id AS rwID, rw.nama_rw, rt.nama_rt, rt.ketua_rt FROM rw, rt WHERE rw.id = rt.rw_id AND rt.id = '$rt_id'";
                            $procs2 = mysqli_query($conn, $query2);
                            $data = mysqli_fetch_assoc($procs2);
                        ?>
                        <p>Isi form berikut dengan data yang valid :</p>
                        <form action="cores/dashboard/rt/edit-rt-process.php" method="post" accept-charset="utf-8">
                            <input type="hidden" name="rt_id" id="rt_id" value="<?php echo $data['rtID'] ?>">
                            <div class="form-group">
                                <label class="control-label" for="rw_id">Nama RW</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih RW" id="rw_id" name="rw_id">
                                    <option value="<?php echo $data['rwID'] ?>" selected>RW <?php echo $data['nama_rw'] ?></option>
                                    <?php foreach ($list_data as $value): ?>
                                        <option value="<?php echo $value['id'] ?>">RW <?php echo $value['nama_rw'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="nama">Nama RT</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_rt'] ?>">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="ketua">Nama Ketua RT</label>
                                <input type="text" class="form-control" name="ketua" id="ketua" value="<?php echo $data['ketua_rt'] ?>">
                            </div><br>
                            <a href="?page=kelola-rt" class="btn btn-default"><i class="material-icons">table_chart</i></a>
                            <button type="reset" class="btn btn-default"><i class="material-icons">refresh</i></button>
                            <button type="submit" class="btn btn-fill btn-success pull-right">
                                <i class="material-icons">archive</i> 
                                SIMPAN
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