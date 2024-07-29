<?php
session_start();
require 'functions.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION["loginadmin"])) {
    header("Location: halamanadmin.php");
    exit;
}

// Pagination setup
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * ($halamanAktif - 1));


$buku = query("SELECT * FROM buku LIMIT $awalData, $jumlahDataPerHalaman");


if (isset($_POST["cari"])) {
    $buku = cariBuku($_POST["keyword"]);
}


$user = $_SESSION["loginadmin"];
$data = query("SELECT * FROM user WHERE id = $user")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="halamanadmin.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>
        <main>
            <p>Selamat datang, admin <?= htmlspecialchars($data['username']) ?>!</p>
            <form action="halamanadminlogout.php" method="post">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </main>
    </div>

    <br><br>
    <form action="" method="post" class="form-cari">
        <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari" class="cari">Cari!</button>
    </form>

    <br>
    <div class="button-container">
        <a href="tambahbuku.php" class="button tambah">Tambah Buku</a>
    </div>

    <div class="card-container">
        <?php foreach ($buku as $row) : ?>
        <div class="card">
            <img src="img/<?= htmlspecialchars($row["gambar"]) ?>" alt="<?= htmlspecialchars($row["judul"]) ?>" class="card-img">
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($row["judul"]) ?></h3>
                <p><strong>Penerbit:</strong> <?= htmlspecialchars($row["penerbit"]) ?></p>
                <p><strong>Tahun Terbit:</strong> <?= htmlspecialchars($row["tahun_terbit"]) ?></p>
                <p><strong>Jumlah Buku:</strong> <?= htmlspecialchars($row["jumlah_buku"]) ?></p>
                <a href="ubahbuku.php?id=<?= $row['id'] ?>" class="button ubah">Ubah</a>
                <a href="hapusbuku.php?id=<?= $row['id'] ?>" class="button hapus">Hapus</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="nav">
        <?php if ($halamanAktif > 1) : ?>
            <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
                <a href="?halaman=<?= $i ?>" style="font-weight: bold; color: red;"><?= $i ?></a>
            <?php else : ?>
                <a href="?halaman=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
        <?php endif; ?>
    </div>
</body>
</html>
