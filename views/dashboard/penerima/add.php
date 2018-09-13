<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Penerima -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Isi form berikut dengan data yang valid :</p><br>
                        <form action="cores/dashboard/penerima/add-penerima-process.php" method="post" accept-charset="utf-8">
                            <div class="form-group label-floating">
                                <label class="control-label" for="no_kk">Nomor Kartu Keluarga</label>
                                <input type="text" class="form-control" name="no_kk" id="no_kk">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="kepala_keluarga">Nama Kepala Keluarga</label>
                                <input type="text" class="form-control" name="kepala_keluarga" id="kepala_keluarga">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="alamat">Alamat Lengkap</label>
                                <input type="text" class="form-control" name="alamat" id="alamat">
                            </div>
                            <?php  
                                $lRW = [];
                                $qRW = "SELECT * FROM rw";
                                $pRW = mysqli_query($conn, $qRW);
                                while($rRW = mysqli_fetch_array($pRW)) {
                                    $lRW[] = $rRW;
                                }
                            ?>
                            <div class="form-group">
                                <label class="control-label" for="rw_id">Nama RW</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih RW" id="rw_id" name="rw_id">
                                    <option disabled> Pilih RW</option>
                                    <?php foreach ($lRW as $value): ?>
                                        <option value="<?php echo $value['id'] ?>"> RW <?php echo $value['nama_rw'].' : '.$value['ketua_rw'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="rt_id">Nama RT</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih RT" id="rt_id" name="rt_id">
                                    <option disabled> Pilih RT</option>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="telepon">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="telepon">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="latitude">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id="latitude">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="longitude">Longitude</label>
                                <input type="text" class="form-control" name="longitude" id="longitude">
                            </div>
                            <?php  
                                $lBantuan = [];
                                $qBantuan = "SELECT * FROM bantuan";
                                $pBantuan = mysqli_query($conn, $qBantuan);
                                while($rBantuan = mysqli_fetch_array($pBantuan)) {
                                    $lBantuan[] = $rBantuan;
                                }
                            ?>
                            <div class="form-group">
                                <label class="control-label" for="bantuan_id">Bantuan Yang Diterima</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Bantuan" id="bantuan_id" name="bantuan_id">
                                    <option disabled> Pilih Bantuan</option>
                                    <?php foreach ($lBantuan as $value): ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nama_bantuan'].' '.$value['banyak_bantuan'].' '.$value['satuan'].' ( Rp '.number_format($value['nominal']).' )' ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="foto">Foto Rumah</label>
                                <input type="file" name="foto" id="foto" class="form-control">
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