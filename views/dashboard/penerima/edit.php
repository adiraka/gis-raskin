<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Ubah Penerima -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Isi form berikut dengan data yang valid :</p><br>
                        <?php  
                            $penerimaID = sanitizeThis($_GET['id']);
                            // $query = "SELECT * FROM penerima WHERE id = '$penerimaID'";
                            $query = "
                                SELECT penerima.id AS penerimaID, penerima.no_kk, penerima.kepala_keluarga, penerima.alamat, penerima.telepon, penerima.latitude, penerima.longitude, rw.id AS rwID, rw.nama_rw, rw.ketua_rw, rt.id AS rtID, rt.nama_rt, rt.ketua_rt, bantuan.id AS bantuanID, bantuan.nama_bantuan, bantuan.banyak_bantuan, bantuan.satuan, bantuan.nominal 
                                FROM penerima, rw, rt, bantuan 
                                WHERE rw.id = rt.rw_id AND rt.id = penerima.rt_id AND bantuan.id = penerima.bantuan_id AND penerima.id = '$penerimaID'
                            ";
                            $procs = mysqli_query($conn, $query);
                            $data = mysqli_fetch_assoc($procs);
                        ?>
                        <form action="cores/dashboard/penerima/edit-penerima-process.php" method="post" accept-charset="utf-8">
                            <input type="hidden" name="penerima_id" id="penerima_id" value="<?php echo $penerimaID ?>">
                            <div class="form-group label-floating">
                                <label class="control-label" for="no_kk">Nomor Kartu Keluarga</label>
                                <input type="text" class="form-control" name="no_kk" id="no_kk" value="<?php echo $data['no_kk'] ?>">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="kepala_keluarga">Nama Kepala Keluarga</label>
                                <input type="text" class="form-control" name="kepala_keluarga" id="kepala_keluarga" value="<?php echo $data['kepala_keluarga'] ?>">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="alamat">Alamat Lengkap</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $data['alamat'] ?>">
                            </div>
                            <?php  
                                $lRW = [];
                                $qRW = "SELECT * FROM rw";
                                $pRW = mysqli_query($conn, $qRW);
                                while($rRW = mysqli_fetch_array($pRW)) {
                                    $lRW[] = $rRW;
                                }
                            ?>
                            <div class="form-group label-floating">
                                <label class="control-label" for="rw_id">Nama RW</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih RW" id="rw_id" name="rw_id">
                                    <option disabled> Pilih RW</option>
                                    <option value="<?php echo $data['rwID'] ?>" selected>RW <?php echo $data['nama_rw'].' : '.$data['ketua_rw'] ?></option>
                                    <?php foreach ($lRW as $value): ?>
                                        <option value="<?php echo $value['id'] ?>"> RW <?php echo $value['nama_rw'].' : '.$value['ketua_rw'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="rt_id">Nama RT</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih RT" id="rt_id" name="rt_id">
                                    <option disabled> Pilih RT</option>
                                    <option value="<?php echo $data['rtID'] ?>" selected>RT <?php echo $data['nama_rt'].' : '.$data['ketua_rt'] ?></option>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="telepon">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="telepon" value="<?php echo $data['telepon'] ?>">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="latitude">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo $data['latitude'] ?>">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="longitude">Longitude</label>
                                <input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo $data['longitude'] ?>">
                            </div>
                            <?php  
                                $lBantuan = [];
                                $qBantuan = "SELECT * FROM bantuan";
                                $pBantuan = mysqli_query($conn, $qBantuan);
                                while($rBantuan = mysqli_fetch_array($pBantuan)) {
                                    $lBantuan[] = $rBantuan;
                                }
                            ?>
                            <div class="form-group label-floating">
                                <label class="control-label" for="bantuan_id">Bantuan Yang Diterima</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Bantuan" id="bantuan_id" name="bantuan_id">
                                    <option disabled> Pilih Bantuan</option>
                                    <option value="<?php echo $data['bantuanID'] ?>" selected><?php echo $data['nama_bantuan'].' '.$data['banyak_bantuan'].' '.$data['satuan'].' ( Rp '.number_format($data['nominal']).' )' ?></option>
                                    <?php foreach ($lBantuan as $value): ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nama_bantuan'].' '.$value['banyak_bantuan'].' '.$value['satuan'].' ( Rp '.number_format($value['nominal']).' )' ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <br>
                            <a href="?page=kelola-penerima" class="btn btn-default"><i class="material-icons">table_chart</i></a>
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