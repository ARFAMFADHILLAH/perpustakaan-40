<?php
session_start();
require 'functions.php';


if (!isset($_SESSION["loginanggota"])) {
    header("Location: halamananggota.php");
    exit;
}


$id = $_GET['id'];


if (kembalikanBuku($id) > 0) {
    echo "
        <script>
            alert('Buku berhasil dikembalikan!');
            document.location.href = 'halamananggota.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal mengembalikan buku!');
            document.location.href = 'halamananggota.php';
        </script>
    ";
}
?>
