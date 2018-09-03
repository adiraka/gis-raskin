<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Laporan Tahunan -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Pilih Menu Berikut Untuk Mencetak Laporan :</p><br>
                        <form action="views/dashboard/laporan/cetak-tahun.php" method="get" accept-charset="utf-8" target="_blank" id="form-laporan">
                            <div class="form-group label-floating">
                                <label class="control-label" for="tahun">Tahun Periode Pemberian Bantuan</label>
                                <input type="text" class="form-control" name="tahun" id="tahun" required>
                            </div>
                            <div class="form-group">
                                <?php  
                                    $lBantuan = [];
                                    $qBantuan = "SELECT * FROM bantuan";
                                    $pBantuan = mysqli_query($conn, $qBantuan);
                                    while($rBantuan = mysqli_fetch_array($pBantuan)) {
                                        $lBantuan[] = $rBantuan;
                                    }
                                ?>
                                <label class="control-label" for="bantuan_id">Bantuan Yang Diberikan</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Bantuan Yang Diterima" id="bantuan_id" name="bantuan_id" data-live-search="true" required>
                                    <option disabled> Pilih Bantuan Yang Diberikan</option>
                                    <?php foreach ($lBantuan as $value): ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nama_bantuan'].' '.$value['banyak_bantuan'].' '.$value['satuan'].' ( Rp '.number_format($value['nominal']).' )' ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div><br>
                            <button type="submit" class="btn btn-fill btn-success pull-right">
                                <i class="material-icons">print</i> 
                                CETAK
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