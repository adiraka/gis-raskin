<div class="sidebar" data-active-color="green" data-background-color="white" data-image="assets/vendors/material-dashboard-pro/assets/img/sidebar-1.jpg">
    <div class="logo">
        <a href="?page=beranda" class="simple-text logo-mini">
            DS
        </a>
        <a href="?page=beranda" class="simple-text logo-normal">
            SPDPKM
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
            <li class="<?php echo ($_GET['page'] == 'kelola-rw')?'active':''; ?>">
                <a href="?page=kelola-rw">
                    <i class="material-icons">description</i>
                    <p>Kelola RW</p>
                </a>
            </li>
            <li class="">
                <a href="?page=beranda">
                    <i class="material-icons">description</i>
                    <p>Kelola RT</p>
                </a>
            </li>
            <li class="">
                <a href="?page=beranda">
                    <i class="material-icons">card_giftcard</i>
                    <p>Kelola Bantuan</p>
                </a>
            </li>
            <li class="">
                <a href="?page=beranda">
                    <i class="material-icons">people</i>
                    <p>Kelola Penerima</p>
                </a>
            </li>
            <li class="">
                <a href="?page=beranda">
                    <i class="material-icons">how_to_reg</i>
                    <p>Pemberian Bantuan</p>
                </a>
            </li>
            <li class="">
                <a href="?page=beranda">
                    <i class="material-icons">assignment</i>
                    <p>Laporan</p>
                </a>
            </li>
        </ul>
    </div>
</div>