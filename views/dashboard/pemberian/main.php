<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">how_to_reg</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Kelola Pemberian Bantuan -
                    <small class="category">Sistem Pengolahan Data Pesebaran Keluarga Miskin</small>
                </h4>
                <hr>
                <p>Klik tombol di bawah untuk menambahkan Pemberian Bantuan baru :</p>
                <a href="?page=tambah-pemberian" class="btn btn-success">
                    <i class="material-icons">add</i> 
                    Tambah Pemberian Bantuan
                </a><br><hr>
                <p>Berikut adalah tabel data Pemberian Bantuan yang telah dilaksanakan :</p>
                <div class="material-datatables">
                    <table id="data-rt" class="table table-striped table-no-bordered table-hover nowrap" cellspacing="0" width="100%" style="width:100%">
                        <?php  
                            $list_data = [];
                            $query = "
                                SELECT pemberian.id, pemberian.bulan, pemberian.tahun, pemberian.tanggal, penerima.no_kk, penerima.kepala_keluarga, bantuan.nama_bantuan, bantuan.banyak_bantuan, bantuan.satuan, bantuan.nominal 
                                FROM pemberian, penerima, bantuan 
                                WHERE pemberian.penerima_id = penerima.id AND pemberian.bantuan_id = bantuan.id
                            ";
                            $procs = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($procs)) {
                                $list_data[] = $row;
                            }
                        ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Periode</th>
                                <th>Penerima</th>
                                <th>Jenis Bantuan</th>
                                <th>Tanggal</th>
                                <th class="disabled-sorting">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_data as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $listBulan[$value['bulan']].' '.$value['tahun'] ?></td>
                                    <td><?php echo $value['no_kk'].' - '.$value['kepala_keluarga'] ?></td>
                                    <td><?php echo $value['nama_bantuan'].' '.$value['banyak_bantuan'].$value['satuan'].' (Rp.'.number_format($value['nominal']).')' ?></td>
                                    <td><?php echo date('d M Y', strtotime($value['tanggal'])) ?></td>
                                    <td>
                                        <a href="?page=ubah-pemberian&id=<?php echo $value['id'] ?>" class="btn btn-round btn-simple btn-success btn-icon"><i class="material-icons">create</i></a>
                                        <a href="?page=hapus-pemberian&id=<?php echo $value['id'] ?>" class="btn btn-round btn-simple btn-danger btn-icon"><i class="material-icons">close</i></a>
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