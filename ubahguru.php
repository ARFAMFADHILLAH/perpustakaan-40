<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$id = $_GET["id"];
$guru = query("SELECT * FROM gurusekolah WHERE id = $id")[0];
if( isset($_POST["submit"]) ) {
if ( ubahGuru($_POST) > 0 ) {
    echo "
    <script>
    alert('data berhasil diubah!');
    document.location.href='index.php';
    </script>";

    } else {
        echo "
    <script>
    alert('data gagal diubah!');
    document.location.href='index.php';
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data guru</title>
    <link rel="stylesheet" href="ubah.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Ubah data guru</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $guru["id"]; ?>">
        <input type="hidden" name="gambar_lama" value="<?= $guru["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?= $guru["nama"] ?>">
            </li>
            <li>
                <label for="nip">Nip</label>
                <input type="text" name="nip" id="nip" required value="<?= $guru["nip"] ?>">
            </li>
            <li>
                <label for="no_hp">No hp</label>
                <input type="text" name="no_hp" id="no_hp" value="<?= $guru["no_hp"] ?>">
            </li>
            <li>
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="<?= $guru["alamat"] ?>">
            </li>
            <li>
            <label for="gambar">Foto</label>
            <img src="img/<?= $guru['gambar']; ?>" width="70">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>
    </form>
    
</body>
</html>