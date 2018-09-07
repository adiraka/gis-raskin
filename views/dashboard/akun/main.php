<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Kelola Akun -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <p>Klik tombol di bawah untuk menambahkan Akun baru :</p>
                <a href="?page=tambah-akun" class="btn btn-success">
                    <i class="material-icons">add</i> 
                    Tambah Akun Baru
                </a><br><hr>
                <p>Berikut adalah tabel data Akun yang terfadtar :</p>
                <div class="material-datatables">
                    <table id="data-rw" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <?php  
                            $list_data = [];
                            $query = "SELECT * FROM user_akun";
                            $procs = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($procs)) {
                                $list_data[] = $row;
                            }
                        ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>Hak Akses</th>
                                <th>Status</th>
                                <th class="disabled-sorting">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_data as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $value['username'] ?></td>
                                    <td><?php echo $value['nip'] ?></td>
                                    <td><?php echo $value['nama'] ?></td>
                                    <td class="text-center"><?php echo $value['hak_akses'] ?></td>
                                    <td class="text-center"><?php echo $value['status'] ?></td>
                                    <td>
                                        <a href="cores/dashboard/akun/reset-password-process.php?id=<?php echo $value['id'] ?>" class="btn btn-round btn-simple btn-success btn-icon"><i class="material-icons">refresh</i></a>
                                        <a href="cores/dashboard/akun/activation-process.php?stat=<?php echo $value['status'] ?>&id=<?php echo $value['id'] ?>" class="btn btn-round btn-simple btn-danger btn-icon"><i class="material-icons">info</i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
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