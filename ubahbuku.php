<?php
session_start();

// if( !isset($_SESSION["login"]) ) {
//     header("Location: login.php");
//     exit;
// }

require 'functions.php';
$id = $_GET["id"];
$buku = query("SELECT * FROM buku WHERE id = $id")[0];
if( isset($_POST["submit"]) ) {
if ( ubahBuku($_POST) > 0 ) {
    echo "
    <script>
    alert('data berhasil diubah!');
    document.location.href='halamanadmin.php';
    </script>";

    } else {
        echo "
    <script>
    alert('data gagal diubah!');
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
    <title>Ubah data Buku</title>
    <link rel="stylesheet" href="ubah.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Ubah data Buku</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $buku["id"]; ?>">
        <input type="hidden" name="gambarlama" value="<?= $buku["gambar"]; ?>"> 
        <ul>
            <li>
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" value="<?= $buku["judul"]; ?>">
            </li>
            <li>
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" required value="<?= $buku["penerbit"]; ?>">
            </li>
            <li>
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="text" name="tahun_terbit" id="tahun_terbit" value="<?= $buku["tahun_terbit"]; ?>">
            </li>
            <li>
                <label for="jumlah_buku">Jumlah Buku</label>
                <input type="text" name="jumlah_buku" id="jumlah_buku" value="<?= $buku["jumlah_buku"]; ?>">
            </li>
            <li>
                <label for="gambar">Cover</label>
                <img src="img/<?= $buku['gambar']; ?>" width="70">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>

