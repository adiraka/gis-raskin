<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">how_to_reg</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Hapus Pemberian Bantuan -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Apakah anda yakin ingin menghapus data berikut :</p>
                        <form action="cores/dashboard/pemberian/delete-pemberian-process.php" method="post" accept-charset="utf-8">
                            <?php  
                                $pemberianID = sanitizeThis($_GET['id']);
                                $query = "
                                    SELECT pemberian.id AS pemberianID, pemberian.bulan, pemberian.tahun, pemberian.tanggal, penerima.id AS penerimaID, penerima.no_kk, penerima.kepala_keluarga, bantuan.id AS bantuanID, bantuan.nama_bantuan, bantuan.banyak_bantuan, bantuan.satuan, bantuan.nominal 
                                    FROM pemberian, penerima, bantuan 
                                    WHERE pemberian.penerima_id = penerima.id AND pemberian.bantuan_id = bantuan.id AND pemberian.id = '$pemberianID'
                                ";
                                $procs = mysqli_query($conn, $query);
                                $data = mysqli_fetch_assoc($procs);
                            ?>
                            <input type="hidden" name="pemberian_id" id="pemberian_id" value="<?php echo $pemberianID ?>">
                            <div class="form-group">
                                <label class="control-label" for="bulan">Bulan Periode Pemberian Bantuan</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Bulan" id="bulan" name="bulan">
                                    <option value="<?php echo $data['bulan'] ?>" selected><?php echo $listBulan[$data['bulan']] ?></option>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="tahun">Tahun Periode Pemberian Bantuan</label>
                                <input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $data['tahun'] ?>" readonly>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="penerima_id">Penerima Bantuan</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Penerima Bantuan" id="penerima_id" name="penerima_id">
                                    <option value="<?php echo $data['penerimaID'] ?>" selected><?php echo $data['no_kk'].' - '.$data['kepala_keluarga'] ?></option>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="bantuan_id">Bantuan Yang Diberikan</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Bantuan Yang Diterima" id="bantuan_id" name="bantuan_id">
                                    <option value="<?php echo $data['bantuanID'] ?>" selected><?php echo $data['nama_bantuan'].' '.$data['banyak_bantuan'].' '.$data['satuan'].' ( Rp '.number_format($data['nominal']).' )' ?></option>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal Pemberian Bantuan" value="<?php echo $data['tanggal'] ?>" readonly>
                            </div><br>
                            <a href="?page=kelola-pemberian" class="btn btn-default"><i class="material-icons">table_chart</i></a>
                            <button type="reset" class="btn btn-default"><i class="material-icons">refresh</i></button>
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