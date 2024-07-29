<?php 
require 'functions.php'; 
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Query untuk mengambil data anggota, buku, dan admin untuk dropdown
$anggota = query("SELECT id, nama FROM anggota");
$buku = query("SELECT id, judul FROM buku");
$admin = query("SELECT id, nama FROM admin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="tambahtransaksi.css">
</head>
<body>
    <div class="form-container">
        <form action="proses_tambah_transaksi.php" method="post">
            <label for="f_tanggalpeminjaman">Tanggal Peminjaman:</label>
            <input type="date" id="f_tanggalpeminjaman" name="f_tanggalpeminjaman" required><br>
            <label for="f_tanggalpengembalian">Tanggal pengembalian:</label>
            <input type="date" id="f_tanggalpengembalian" name="f_tanggalpengembalian" required><br>
            <label for="f_idpeminjam">ID Peminjam:</label>
            <select id="f_idpeminjam" name="f_idpeminjam" required>
                <?php foreach ($anggota as $a): ?>
                    <option value="<?= htmlspecialchars($a['id']); ?>"><?= htmlspecialchars($a['nama']); ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="f_idbuku">ID Buku:</label>
            <select id="f_idbuku" name="f_idbuku" required>
                <?php foreach ($buku as $b): ?>
                    <option value="<?= htmlspecialchars($b['id']); ?>"><?= htmlspecialchars($b['judul']); ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="f_idadmin">ID Admin:</label>
            <select id="f_idadmin" name="f_idadmin" required>
                <?php foreach ($admin as $a): ?>
                    <option value="<?= htmlspecialchars($a['id']); ?>"><?= htmlspecialchars($a['nama']); ?></option>
                <?php endforeach; ?>
            </select><br>

            <input type="submit" name="submit" value="Tambah Transaksi" class="button-submit">
        </form>
        <a href="transaksi.php" class="button-kembali">Kembali</a>
    </div>
</body>
</html>
