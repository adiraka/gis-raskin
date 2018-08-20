<div class="card card-profile">
    <div class="card-avatar">
        <a href="#">
            <img class="img" src="assets/img/avatar.png" />
        </a>
    </div>
    <div class="card-content">
        <h6 class="category text-gray"><?php echo $_SESSION['akses']; ?></h6>
        <h4 class="card-title"><?php echo $profil['nama'] ?></h4>
        <p class="description">
            NIP. <?php echo $profil['nip'] ?>
        </p>
    </div>
</div>