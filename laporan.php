<?php

require 'functions.php';
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mengambil data laporan
$laporan = [];

// Peminjaman Terbanyak
$sql1 = "SELECT buku.judul, COUNT(*) AS jumlah_peminjaman 
         FROM laporan 
         INNER JOIN buku ON laporan.f_judulbuku = buku.id 
         GROUP BY buku.judul 
         ORDER BY jumlah_peminjaman DESC 
         LIMIT 1";
$result1 = mysqli_query($conn, $sql1);
$peminjaman_terbanyak = mysqli_fetch_assoc($result1);
$laporan['peminjaman_terbanyak'] = $peminjaman_terbanyak['judul'] . " (" . $peminjaman_terbanyak['jumlah_peminjaman'] . " kali)";

// Anggota Paling Aktif
$sql2 = "SELECT f_anggota, COUNT(*) AS jumlah_aktif 
         FROM laporan 
         GROUP BY f_anggota 
         ORDER BY jumlah_aktif DESC 
         LIMIT 1";
$result2 = mysqli_query($conn, $sql2);
$anggota_paling_aktif = mysqli_fetch_assoc($result2);
$laporan['anggota_paling_aktif'] = $anggota_paling_aktif['f_anggota'] . " (" . $anggota_paling_aktif['jumlah_aktif'] . " kali)";

// Buku Belum Dikembalikan
$sql3 = "SELECT COUNT(*) AS jumlah_belum_dikembalikan 
         FROM laporan 
         WHERE status = 'belum dikembalikan'";
$result3 = mysqli_query($conn, $sql3);
$buku_belum_dikembalikan = mysqli_fetch_assoc($result3);
$laporan['buku_belum_dikembalikan'] = $buku_belum_dikembalikan['jumlah_belum_dikembalikan'] . " buku";

// Judul Buku Paling Sering Dipinjam
$sql4 = "SELECT buku.judul, COUNT(*) AS jumlah_dipinjam 
         FROM laporan 
         INNER JOIN buku ON laporan.f_judulbuku = buku.id 
         GROUP BY buku.judul 
         ORDER BY jumlah_dipinjam DESC 
         LIMIT 1";
$result4 = mysqli_query($conn, $sql4);
$judul_paling_sering_dipinjam = mysqli_fetch_assoc($result4);
$laporan['judul_paling_sering_dipinjam'] = $judul_paling_sering_dipinjam['judul'] . " (" . $judul_paling_sering_dipinjam['jumlah_dipinjam'] . " kali)";

// Admin Paling Aktif
$sql5 = "SELECT f_admin, COUNT(*) AS jumlah_aktif 
         FROM laporan 
         GROUP BY f_admin 
         ORDER BY jumlah_aktif DESC 
         LIMIT 1";
$result5 = mysqli_query($conn, $sql5);
$admin_paling_aktif = mysqli_fetch_assoc($result5);
$laporan['admin_paling_aktif'] = $admin_paling_aktif['f_admin'] . " (" . $admin_paling_aktif['jumlah_aktif'] . " kali)";

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="transaksi.css">
</head>
<body>
    <h1>Tabel laporan</h1>
    <table>
        <thead>
            <tr>
                <th>Peminjaman terbanyak</th>
                <th>Anggota paling aktif</th>
                <th>Buku belum dikembalikan</th>
                <th>Judul buku paling sering dipinjam</th>
                <th>Admin paling aktif</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($laporan['peminjaman_terbanyak']); ?></td>
                <td><?= htmlspecialchars($laporan['anggota_paling_aktif']); ?></td>
                <td><?= htmlspecialchars($laporan['buku_belum_dikembalikan']); ?></td>
                <td><?= htmlspecialchars($laporan['judul_paling_sering_dipinjam']); ?></td>
                <td><?= htmlspecialchars($laporan['admin_paling_aktif']); ?></td>
            </tr>
        </tbody>
    </table>
    <div class="button-container">
        <a href="index.php" class="button-kembali">Kembali</a>
    </div>
</body>
</html>
