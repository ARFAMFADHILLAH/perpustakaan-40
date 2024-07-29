<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require'functions.php';

if( isset($_POST["submit"]) ) {

if ( tambahGuru ($_POST) > 0 ) {
    echo "
    <script>
    alert('data berhasil ditambahkan!');
    document.location.href='index.php';
    </script>";
    } else {
        echo "
    <script>
    alert('data gagal ditambahkan!');
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
    <title>Tambah data guru</title>
    <link rel="stylesheet" href="tambah.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Tambah data guru</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="nip">Nip</label>
                <input type="text" name="nip" id="nip"
                required>
            </li>
            <li>
                <label for="no_hp">No hp</label>
                <input type="text" name="no_hp" id="no_hp">
            </li>
            <li>
                <li class="image">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto">
                </li>
                <li>
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat">
            </li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
    
</body>
</html>