<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Kelola Penerima -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <p>Klik tombol di bawah untuk menambahkan Penerima baru :</p>
                <a href="?page=tambah-penerima" class="btn btn-success">
                    <i class="material-icons">add</i> 
                    Tambah Penerima Baru
                </a><br><hr>
                <p>Berikut adalah tabel data Penerima yang terdaftar :</p>
                <div class="material-datatables">
                    <table id="data-rt" class="table table-striped table-no-bordered table-hover nowrap" cellspacing="0" width="100%" style="width:100%">
                        <?php  
                            $list_data = [];
                            $query = "
                                SELECT penerima.id, penerima.no_kk, penerima.kepala_keluarga, penerima.alamat, penerima.telepon, penerima.latitude, penerima.longitude, rw.nama_rw, rt.nama_rt, bantuan.nama_bantuan, bantuan.banyak_bantuan, bantuan.satuan, bantuan.nominal 
                                FROM penerima, rw, rt, bantuan 
                                WHERE rw.id = rt.rw_id AND rt.id = penerima.rt_id AND bantuan.id = penerima.bantuan_id
                            ";
                            $procs = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($procs)) {
                                $list_data[] = $row;
                            }
                        ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No KK</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>RW/RT</th>
                                <th>Telepon</th>
                                <th>Jenis Bantuan</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th class="disabled-sorting">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_data as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $value['no_kk'] ?></td>
                                    <td><?php echo $value['kepala_keluarga'] ?></td>
                                    <td><?php echo $value['alamat'] ?></td>
                                    <td><?php echo 'RW. '.$value['nama_rw'].'/RT. '.$value['nama_rt'] ?></td>
                                    <td><?php echo $value['telepon'] ?></td>
                                    <td><?php echo $value['nama_bantuan'].' '.$value['banyak_bantuan'].$value['satuan'].' (Rp.'.number_format($value['nominal']).')' ?></td>
                                    <td><?php echo $value['latitude'] ?></td>
                                    <td><?php echo $value['longitude'] ?></td>
                                    <td>
                                        <a href="?page=ubah-penerima&id=<?php echo $value['id'] ?>" class="btn btn-round btn-simple btn-success btn-icon"><i class="material-icons">create</i></a>
                                        <a href="?page=hapus-penerima&id=<?php echo $value['id'] ?>" class="btn btn-round btn-simple btn-danger btn-icon"><i class="material-icons">close</i></a>
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