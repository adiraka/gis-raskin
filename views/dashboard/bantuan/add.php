<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">card_giftcard</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Bantuan -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Isi form berikut dengan data yang valid :</p><br>
                        <form action="cores/dashboard/bantuan/add-bantuan-process.php" method="post" accept-charset="utf-8">
                            <div class="form-group label-floating">
                                <label class="control-label" for="nama">Nama Bantuan</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="banyak">Banyak Bantuan</label>
                                <input type="text" class="form-control" name="banyak" id="banyak">
                            </div>
                            <div class="form-group">
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Satuan" id="satuan" name="satuan">
                                    <option disabled> Pilih Satuan</option>
                                    <option value="kg">KG</option>
                                    <option value="liter">LITER</option>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="nominal">Nominal Dalam Rp</label>
                                <input type="text" class="form-control" name="nominal" id="nominal">
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