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
    <title>Halaman Admin</title>
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
    <div class="nav-links">
        <a href="index.php" class="link2">
            <h2>Anggota</h2>
        </a>
        <a href="guru.php" class="link">
            <h2>Admin</h2>
        </a>
        </a>
        <a href="transaksi.php" class="link">
            <h2>Transaksi</h2>
        </a>
    </div>
</div>
    <br><br>
    
    <form action="" method="post" class="form-cari">
        <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari" class="button cari">Cari!</button>
        
        <img src="img/Spinner@1x-1.0s-200px-200px.gif" class="loader">
    </form>

    <br>

        <div class="button-container">
            <a href="tambahbuku.php" class="tambah">Tambah</a>
            <a href="logout.php" class="button logout">Logout</a>
            
            </div>
    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th class="aksi">Aksi</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penerbit</th>
                <th>Tahun terbit</th>
                <th>Jumlah buku</th>
            </tr>
            
        <?php $i = 1; ?>
        <?php foreach( $buku as $row ) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td class="aksi">
                <a href="ubahbuku.php?id=<?= $row["id"]; ?>">ubah</a> |
                <a href="hapusbuku.php?id=<?= $row["id"]; ?>" onclick="
                    return confirm('yakin?');">hapus</a>
            </td>
            <td><img src="img/<?= $row["gambar"]; ?>" width="100"></td>
            <td><?= $row["judul"]; ?></td>"
            <td><?= $row["penerbit"]; ?></td>
            <td><?= $row["tahun_terbit"]; ?></td>
            <td><?= $row["jumlah_buku"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
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
