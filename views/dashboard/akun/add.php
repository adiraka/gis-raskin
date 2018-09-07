<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Akun -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Isi form berikut dengan data yang valid :</p><br>
                        <form action="cores/dashboard/akun/add-akun-process.php" method="post" accept-charset="utf-8">
                            <div class="form-group label-floating">
                                <label class="control-label" for="nip">NIP</label>
                                <input type="text" class="form-control" name="nip" id="nip">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="konf_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="konf_password" id="konf_password">
                            </div>
                            <br>
                            <a href="?page=kelola-akun" class="btn btn-default"><i class="material-icons">table_chart</i></a>
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