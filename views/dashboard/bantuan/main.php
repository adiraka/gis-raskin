<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">card_giftcard</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Kelola Bantuan -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <p>Klik tombol di bawah untuk menambahkan Jenis Bantuan baru :</p>
                <a href="?page=tambah-bantuan" class="btn btn-success">
                    <i class="material-icons">add</i> 
                    Tambah Jenis Bantuan Baru
                </a><br><hr>
                <p>Berikut adalah tabel data Jenis Bantuan yang terdaftar :</p>
                <div class="material-datatables">
                    <table id="data-rt" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <?php  
                            $list_data = [];
                            $query = "SELECT * FROM bantuan";
                            $procs = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($procs)) {
                                $list_data[] = $row;
                            }
                        ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Bantuan</th>
                                <th>Banyak</th>
                                <th>Nominal (Rp)</th>
                                <th class="disabled-sorting">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_data as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $value['nama_bantuan'] ?></td>
                                    <td><?php echo $value['banyak_bantuan'].' '.$value['satuan'] ?></td>
                                    <td><?php echo number_format($value['nominal']) ?></td>
                                    <td>
                                        <a href="?page=ubah-bantuan&id=<?php echo $value['id'] ?>" class="btn btn-round btn-simple btn-success btn-icon"><i class="material-icons">create</i></a>
                                        <a href="?page=hapus-bantuan&id=<?php echo $value['id'] ?>" class="btn btn-round btn-simple btn-danger btn-icon"><i class="material-icons">close</i></a>
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