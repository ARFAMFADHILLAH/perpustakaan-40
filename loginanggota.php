<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Check if cookies are set
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // Check cookie and username hash
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['loginanggota'] = true;
    }
}

// Redirect if already logged in
if (isset($_SESSION["loginanggota"])) {
    header("Location: halamananggota.php");
    exit;
}

// Handle login
if (isset($_POST["loginanggota"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if username exists
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row["password"])) {
            $_SESSION["loginanggota"] = true;

            // Check "remember me" option
            if (isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: halamananggota.php");
            exit;
        }
    }
    $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota Login</title>
    <link rel="stylesheet" href="loginadmin.css">
</head>
<body>
<?php if( isset($error) ) : ?>
        <p class="error-message">*Username/password salah</p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" name="loginanggota">Login</button>
    </form>
</body>
</html>
