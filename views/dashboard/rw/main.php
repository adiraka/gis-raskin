<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">description</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Kelola RW -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <p>Klik tombol di bawah untuk menambahkan RW baru :</p>
                <a href="?page=tambah-rw" class="btn btn-success">
                    <i class="material-icons">add</i> 
                    Tambah RW Baru
                </a><br><hr>
                <p>Berikut adalah tabel data RW yang berada pada Kelurahan Koto Panjang :</p>
                <div class="material-datatables">
                    <table id="data-rw" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama RW</th>
                                <th>Nama Ketua RW</th>
                                <th class="disabled-sorting">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>2</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php include 'views/partials/rightbar.php'; ?>
    </div>
</div>