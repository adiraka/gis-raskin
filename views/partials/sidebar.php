<div class="sidebar" data-active-color="green" data-background-color="white" data-image="assets/vendors/material-dashboard-pro/assets/img/sidebar-1.jpg">
    <div class="logo">
        <a href="?page=beranda" class="simple-text logo-mini">
            MY
        </a>
        <a href="?page=beranda" class="simple-text logo-normal">
            DASHBOARD
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="assets/img/avatar.png" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="user.html#collapseExample" class="collapsed">
                    <span>
                        <?php echo $profil['nama'] ?>
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="user.html#">
                                <span class="sidebar-mini">UP</span>
                                <span class="sidebar-normal">Ubah Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=keluar">
                                <span class="sidebar-mini">KL</span>
                                <span class="sidebar-normal">Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="<?php echo ($_GET['page'] == 'beranda')?'active':''; ?>">
                <a href="?page=beranda">
                    <i class="material-icons">home</i>
                    <p>Beranda</p>
                </a>
            </li>
            <?php  
                if ($_SESSION['akses'] == 'staff') {
            ?>
                <li class="<?php echo ($_GET['page'] == 'kelola-rw')?'active':''; ?>">
                    <a href="?page=kelola-rw">
                        <i class="material-icons">description</i>
                        <p>Kelola RW</p>
                    </a>
                </li>
                <li class="<?php echo ($_GET['page'] == 'kelola-rt')?'active':''; ?>">
                    <a href="?page=kelola-rt">
                        <i class="material-icons">description</i>
                        <p>Kelola RT</p>
                    </a>
                </li>
                <li class="<?php echo ($_GET['page'] == 'kelola-bantuan')?'active':''; ?>">
                    <a href="?page=kelola-bantuan">
                        <i class="material-icons">card_giftcard</i>
                        <p>Kelola Bantuan</p>
                    </a>
                </li>
                <li class="<?php echo ($_GET['page'] == 'kelola-penerima')?'active':''; ?>">
                    <a href="?page=kelola-penerima">
                        <i class="material-icons">people</i>
                        <p>Kelola Penerima</p>
                    </a>
                </li>
                <li class="<?php echo ($_GET['page'] == 'kelola-pemberian')?'active':''; ?>">
                    <a href="?page=kelola-pemberian">
                        <i class="material-icons">how_to_reg</i>
                        <p>Pemberian Bantuan</p>
                    </a>
                </li>
                <li class="<?php echo ($_GET['page'] == 'laporan-bulanan')?'active':''; ?>">
                    <a href="?page=laporan-bulanan">
                        <i class="material-icons">assignment</i>
                        <p>Laporan Bulanan</p>
                    </a>
                </li>
                <li class="<?php echo ($_GET['page'] == 'laporan-tahunan')?'active':''; ?>">
                    <a href="?page=laporan-tahunan">
                        <i class="material-icons">assignment</i>
                        <p>Laporan Tahunan</p>
                    </a>
                </li>
            <?php
                } elseif ($_SESSION['akses'] == 'admin') {
            ?>
                <li class="<?php echo ($_GET['page'] == 'kelola-akun')?'active':''; ?>">
                    <a href="?page=kelola-akun">
                        <i class="material-icons">people</i>
                        <p>Kelola Akun</p>
                    </a>
                </li>
            <?php
                } elseif ($_SESSION['akses'] == 'lurah') {
            ?>
                <li class="<?php echo ($_GET['page'] == 'laporan-bulanan')?'active':''; ?>">
                    <a href="?page=laporan-bulanan">
                        <i class="material-icons">assignment</i>
                        <p>Laporan Bulanan</p>
                    </a>
                </li>
                <li class="<?php echo ($_GET['page'] == 'laporan-tahunan')?'active':''; ?>">
                    <a href="?page=laporan-tahunan">
                        <i class="material-icons">assignment</i>
                        <p>Laporan Tahunan</p>
                    </a>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>
</div>