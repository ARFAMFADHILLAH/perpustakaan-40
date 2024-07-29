<?php
require 'functions.php';
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Cek jika transaksi_id sudah dikirimkan
if (isset($_POST["transaksi_id"])) {
    $transaksi_id = htmlspecialchars($_POST["transaksi_id"]);

    // Query untuk menghapus transaksi
    $query = "DELETE FROM transaksi WHERE transaksi_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameter dan eksekusi query
    $stmt->bind_param("i", $transaksi_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo "<script>
        alert('Transaksi berhasil dihapus!');
        document.location.href='transaksi.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
        $stmt->close();
        $conn->close();
    }
} else {
    echo "<script>
    alert('Transaksi ID tidak ditemukan!');
    document.location.href='transaksi.php';
    </script>";
}
?>
