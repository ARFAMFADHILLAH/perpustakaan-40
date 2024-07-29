<?php 


require 'functions.php';
$id = $_GET["id"];

$result = hapusBuku($id);

if ($result > 0) {
    echo "
    <script>
    alert('data berhasil dihapus!');
    document.location.href='halamanadmin.php';
    </script>";
} else {
    echo "
    <script>
    alert('data gagal dihapus!');
    document.location.href='halamanadmin.php';
    </script>";
}
?>
