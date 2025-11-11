<?php
// mengaktifkan session
session_start();

include __DIR__ . '/../database.php';

$email = htmlspecialchars(trim($_POST['email']));
$pass  = $_POST['password'];

// Check admin table first
$sql = "SELECT * FROM admin WHERE email=? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$hasil = $stmt->get_result();

if ($hasil->num_rows > 0) {
    $row = $hasil->fetch_assoc();

    if (password_verify($pass, $row['password'])) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['nama'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = 'admin';
        header("Location: ../../sideMenu.php");
        exit();
    }
}

// Check pengguna table for regular users (if admin password wrong or no admin)
$sql_user = "SELECT * FROM pengguna WHERE email=? LIMIT 1";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$hasil_user = $stmt_user->get_result();

if ($hasil_user->num_rows > 0) {
    $row_user = $hasil_user->fetch_assoc();

    if (password_verify($pass, $row_user['password'])) {
        $_SESSION['id'] = $row_user['id'];
        $_SESSION['nama'] = $row_user['username'];
        $_SESSION['email'] = $row_user['email'];
        $_SESSION['role'] = 'user';
        header("Location: ../../pengguna/sideMenu2.php");
        exit();
    }
}

// If no match found
echo "<script type='text/javascript'>alert('Email atau Password salah!');window.location.href='../../index.php';</script>";

$stmt->close();
$stmt_user->close();
$conn->close();
?>
