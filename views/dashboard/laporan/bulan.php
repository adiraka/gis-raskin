<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Laporan Bulanan -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Pilih Menu Berikut Untuk Mencetak Laporan :</p>
                        <form action="" method="get" accept-charset="utf-8" target="_blank" id="form-laporan">
                            <div class="form-group">
                                <label class="control-label" for="bulan">Bulan Periode Pemberian Bantuan</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Bulan" id="bulan" name="bulan" data-live-search="true" required>
                                    <option disabled> Pilih Bulan</option>
                                    <?php 
                                        for ($i = 1; $i <= 12 ; $i++) {
                                            echo '<option value="'.$i.'"> '.$listBulan[$i].'</option>';
                                        }
                                    ?>
                                </select>
                            </div><br>
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
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="jenis_laporan">Jenis Laporan</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Jenis Laporan" id="jenis_laporan" name="jenis_laporan" data-live-search="true" required>
                                    <option disabled> Pilih Jenis Laporan</option>
                                    <option value="keseluruhan">Keseluruhan</option>
                                    <option value="per_rw">Per RW</option>
                                </select>
                            </div>
                            <div class="form-group rw-select-box">
                                <?php  
                                    $lRW = [];
                                    $qRW = "SELECT * FROM rw ORDER BY nama_rw";
                                    $pRW = mysqli_query($conn, $qRW);
                                    while ($rRW = mysqli_fetch_array($pRW)) {
                                        $lRW[] = $rRW;
                                    }
                                ?>
                                <label class="control-label" for="bulan">Nama RW</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Nama RW" id="rw_id" name="rw_id">
                                    <option disabled> Pilih Nama RW</option>
                                    <?php foreach ($lRW as $value): ?>
                                        <option value="<?php echo $value['id'] ?>">RW <?php echo $value['nama_rw'].' : '.$value['ketua_rw'] ?></option>
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

<script> 
    $(function(){

        $('.rw-select-box').hide();
        $('#jenis_laporan').on('change', function(){
            $jenisLaporan = $(this).val();
            if ($jenisLaporan == 'per_rw') {
                $("#form-laporan").attr('action', 'views/dashboard/laporan/cetak-bulan-rw.php');
                $('.rw-select-box').show();
                $('#rw_id').attr('required', 'required');
                $('#rw_id').focus();
            } else if ($jenisLaporan == 'keseluruhan') {
                $("#form-laporan").attr('action', 'views/dashboard/laporan/cetak-bulan-keseluruhan.php');
                $('#rw_id').removeAttr('required');
                $('#rw_id').val(' ');
                $('.rw-select-box').hide();
            }
        });

    });
</script>