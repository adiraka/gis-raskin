<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">card_giftcard</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Ubah Bantuan -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Isi form berikut dengan data yang valid :</p>
                        <?php  
                            $id = $_GET['id'];
                            $query = "SELECT * FROM bantuan WHERE id = '$id'";
                            $procs = mysqli_query($conn, $query);
                            $data = mysqli_fetch_assoc($procs);
                        ?>
                        <form action="cores/dashboard/bantuan/edit-bantuan-process.php" method="post" accept-charset="utf-8">
                            <input type="hidden" name="id" id="id" value="<?php echo $data['id'] ?>"><br>
                            <div class="form-group label-floating">
                                <label class="control-label" for="nama">Nama Bantuan</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_bantuan'] ?>">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="banyak">Banyak Bantuan</label>
                                <input type="text" class="form-control" name="banyak" id="banyak" value="<?php echo $data['banyak_bantuan'] ?>">
                            </div>
                            <div class="form-group">
                                <select class="selectpicker" data-style="select-with-transition" title="Pilih Satuan" id="satuan" name="satuan">
                                    <option disabled> Pilih Satuan</option>
                                    <option selected value="<?php echo $data['satuan'] ?>"><?php echo strtoupper($data['satuan']) ?></option>
                                    <option value="kg">KG</option>
                                    <option value="liter">LITER</option>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="nominal">Nominal Dalam Rp</label>
                                <input type="text" class="form-control" name="nominal" id="nominal" value="<?php echo $data['nominal'] ?>">
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