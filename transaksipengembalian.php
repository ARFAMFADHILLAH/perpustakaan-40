<?php
session_start();
require 'functions.php';
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

$id = $_GET["id"];
$buku = query("SELECT * FROM buku WHERE id= $id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pengembalian</title>
    <link rel="stylesheet" href="tes.css">
</head>
<body>

<div class="card-container">
    <?php if (!empty($buku)): ?>
        <?php foreach ($buku as $row): ?>
            <div class="card">
                <img src="img/<?= htmlspecialchars($row["gambar"]); ?>" alt="<?= htmlspecialchars($row["judul"]); ?>" class="card-img">
                <div class="card-body">
                    <h3 class="card-title"><?= htmlspecialchars($row["judul"]); ?></h3>
                    <p><strong>Penerbit :</strong> <?= htmlspecialchars($row["penerbit"]); ?></p>
                    <p><strong>Tahun Terbit :</strong> <?= htmlspecialchars($row["tahun_terbit"]); ?></p>
                    <p><strong>Jumlah Buku :</strong> <?= htmlspecialchars($row["jumlah_buku"]); ?></p>
                    
                <label for="date"><strong>Tanggal pengembalian</strong></label>
                <input type="date">
                <br><br>
                
                <br><br>
                    <a href="kembalikanbuku.php?id=<?= $row['id'] ?>" class="buttonpinjam">kembalikan</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No books found.</p>
    <?php endif; ?>
</div>
</body>
</html>
