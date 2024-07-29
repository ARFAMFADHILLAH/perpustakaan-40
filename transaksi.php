<?php 


require 'functions.php';
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

$transaksi = query("SELECT transaksi.transaksi_id, anggota.nama AS peminjam, buku.judul, buku.jumlah_buku, transaksi.f_tanggalpeminjaman AS peminjaman, 
transaksi.f_tanggalpengembalian AS pengembalian, transaksi.f_masapinjam AS masapinjam, admin.nama AS admin
FROM transaksi
INNER JOIN anggota ON transaksi.f_idpeminjam = anggota.id
INNER JOIN admin ON transaksi.f_idadmin = admin.id
INNER JOIN buku ON transaksi.f_idbuku = buku.id
");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Transaksi</title>
    <link rel="stylesheet" href="transaksi.css">
</head>
<body>
    <h1>Tabel Transaksi</h1>
    <div class="button-container">
        <a href="tambahtransaksi.php" class="button-tambah">Tambah Transaksi</a>
        <a href="index.php" class="button-kembali">Kembali</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Buku</th>
                <th>Admin</th>
                <th>Anggota</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["transaksi_id"]); ?></td>
                    <td><?= htmlspecialchars($row["judul"]); ?></td>
                    <td><?= htmlspecialchars($row["admin"]); ?></td>
                    <td><?= htmlspecialchars($row["peminjam"]); ?></td>
                    <td><?= htmlspecialchars($row["peminjaman"]); ?></td>
                    <td><?= htmlspecialchars($row["pengembalian"]); ?></td>
                    <td>
                        <!-- Button Hapus -->
                        <form action="hapus_transaksi.php" method="post" style="display:inline;">
                            <input type="hidden" name="transaksi_id" value="<?= htmlspecialchars($row["transaksi_id"]); ?>">
                            <button type="submit" class="button-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
