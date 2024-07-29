<?php
session_start();

require 'functions.php';

if( isset($_POST["submit"]) ) {
    if (tambahBuku($_POST) > 0 ) {
        echo "
        <script>
        alert('data berhasil ditambahkan!');
        document.location.href='halamanadmin.php';
        </script>";
    } else {
        echo "
        <script>
        alert('data gagal ditambahkan!');
        document.location.href='halamanadmin.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data Buku</title>
    <link rel="stylesheet" href="tambah.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Tambah data Buku</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" required>
            </li>
            <li>
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" required>
            </li>
            <li>
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="text" name="tahun_terbit" id="tahun_terbit" required>
            </li>
            <li>
                <label for="jumlah_buku">Jumlah Buku</label>
                <input type="text" name="jumlah_buku" id="jumlah_buku" required>
            </li>
            <li class="image">
                <label for="cover_foto">Cover Buku</label>
                <input type="file" name="cover_foto" id="cover_foto" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
    
</body>
</html>
