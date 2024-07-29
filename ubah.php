<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require'functions.php';
$id = $_GET["id"];
$siswa = query("SELECT * FROM siswa WHERE id = $id")[0];
if( isset($_POST["submit"]) ) {
if ( ubah($_POST) > 0 ) {
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
    <title>Ubah data siswa</title>
    <link rel="stylesheet" href="ubah.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Ubah data siswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $siswa["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $siswa["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?= $siswa["nama"] ?>">
            </li>
            <li>
                <label for="nisn">NISN</label>
                <input type="text" name="nisn" id="nisn" required value="<?= $siswa["nisn"] ?>">
            </li>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?= $siswa["email"] ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $siswa["jurusan"] ?>">
            </li>
            <li>
            <label for="gambar">Gambar</label>
            <img src="img/<?= $siswa['gambar']; ?>" width="70">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>
    </form>
    
</body>
</html>