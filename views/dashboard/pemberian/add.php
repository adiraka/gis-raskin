<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">how_to_reg</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Pemberian Bantuan -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Isi form berikut dengan data yang valid :</p>
                        <form action="cores/dashboard/pemberian/add-pemberian-process.php" method="post" accept-charset="utf-8">
                            <div class="form-group">
                                <label class="control-label" for="bulan">Bulan Periode Pemberian Bantuan</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Bulan" id="bulan" name="bulan" data-live-search="true">
                                    <option disabled> Pilih RW</option>
                                    <?php 
                                        for ($i = 1; $i <= 12 ; $i++) {
                                            echo '<option value="'.$i.'"> '.$listBulan[$i].'</option>';
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="tahun">Tahun Periode Pemberian Bantuan</label>
                                <input type="text" class="form-control" name="tahun" id="tahun">
                            </div>
                            <div class="form-group">
                                <?php  
                                    $lPenerima = [];
                                    $qPenerima = "SELECT * FROM penerima";
                                    $pPenerima = mysqli_query($conn, $qPenerima);
                                    while($rPenerima = mysqli_fetch_array($pPenerima)) {
                                        $lPenerima[] = $rPenerima;
                                    }
                                ?>
                                <label class="control-label" for="penerima_id">Penerima Bantuan</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Penerima Bantuan" id="penerima_id" name="penerima_id" data-live-search="true">
                                    <option disabled> Pilih Penerima Bantuan</option>
                                    <?php foreach ($lPenerima as $value): ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['no_kk'].' - '.$value['kepala_keluarga'] ?></option>
                                    <?php endforeach ?>
                                </select>
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
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Bantuan Yang Diterima" id="bantuan_id" name="bantuan_id" data-live-search="true">
                                    <option disabled> Pilih Bantuan Yang Diberikan</option>
                                    <?php foreach ($lBantuan as $value): ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nama_bantuan'].' '.$value['banyak_bantuan'].' '.$value['satuan'].' ( Rp '.number_format($value['nominal']).' )' ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="Tanggal Pemberian Bantuan">
                            </div><br>
                            <a href="?page=kelola-pemberian" class="btn btn-default"><i class="material-icons">table_chart</i></a>
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