<?php
require 'functions.php';
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST["submit"])) {

    if (tambahtransaksi($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan!');
        document.location.href='transaksi.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan!');
        document.location.href='transaksi.php';
        </script>";
    }
}

// Tutup koneksi
$conn->close();
?>
