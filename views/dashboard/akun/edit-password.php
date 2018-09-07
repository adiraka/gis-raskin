<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">lock</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Ubah Password -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Isi form berikut dengan data yang valid :</p><br>
                        <form action="cores/dashboard/akun/edit-password-process.php" method="post" accept-charset="utf-8">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $profil['id'] ?>">
                            <div class="form-group label-floating">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="konf_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="konf_password" id="konf_password">
                            </div>
                            <br>
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