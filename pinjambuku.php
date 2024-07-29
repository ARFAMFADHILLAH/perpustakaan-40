<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["loginanggota"])) {
    header("Location: halamananggota.php");
    exit;
}
$id = $_GET['id'];

if (pinjamBuku($id) > 0) {
    echo "
        <script>
            alert('Buku berhasil dipinjam!');
            document.location.href = 'halamananggota.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Stok buku tidak mencukupi!');
            document.location.href = 'halamananggota.php';
        </script>
    ";
}
?>
