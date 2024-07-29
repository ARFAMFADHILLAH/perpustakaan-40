<?php

    require 'functions.php';
    $jumlahDataPerHalaman = 2;
    $jumlahData = count(query("SELECT * FROM buku"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * ($halamanAktif - 1));
    
    $buku = query("SELECT * FROM buku LIMIT $awalData, $jumlahDataPerHalaman");
    
    if( isset($_POST["cari"]) ) {
        $buku = cariBuku($_POST["keyword"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERPUS</title>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header-container">
        <a href="index.php" class="link2">
            <img src="img/download__5_-removebg-preview.png" alt="Logo" class="logo">
        </a>
        <div class="header-text">
            <h1>Perpustakaan</h1>
        </div>
        <div class="nav-links">
            <a href="loginanggota.php" class="link2">
                <h2>Anggota</h2>
            </a>
            <a href="loginadmin.php" class="link">
                <h2>Admin</h2>
            </a>
            <a href="transaksi.php" class="link">
                <h2>Transaksi</h2>
            </a>
            <a href="laporan.php" class="link">
                <h2>Laporan</h2>
            </a>
        </div>
    </div>

    <form action="" method="post" class="form-cari">
        <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari" class="cari">Cari!</button>
    </form>

    <div class="card-container">
        <?php foreach( $buku as $row ) : ?>
        <div class="card">
            <img src="img/<?= $row["gambar"]; ?>" alt="<?= $row["judul"]; ?>" class="card-img">
            <div class="card-body">
                <h3 class="card-title"><?= $row["judul"]; ?></h3>
                <p><strong>Penerbit:</strong> <?= $row["penerbit"]; ?></p>
                <p><strong>Tahun Terbit:</strong> <?= $row["tahun_terbit"]; ?></p>
                <p><strong>Jumlah Buku:</strong> <?= $row["jumlah_buku"]; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="nav">
        <?php if( $halamanAktif > 1 ) : ?>
            <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
        <?php endif; ?>
        
        <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
            <?php if( $i == $halamanAktif ) : ?>
                <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
            <?php else : ?>
                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        
        <?php if( $halamanAktif < $jumlahHalaman ) : ?>
            <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
        <?php endif; ?>
    </div>
</body>
</html>

