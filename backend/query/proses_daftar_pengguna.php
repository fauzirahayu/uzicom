<?php
// mengaktifkan session
session_start();

include __DIR__ . '/../database.php';

$nama = htmlspecialchars(trim($_POST['nama']));
$email = htmlspecialchars(trim($_POST['email']));
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validasi input
if (empty($nama) || empty($email) || empty($password) || empty($confirm_password)) {
    echo "<script type='text/javascript'>alert('Semua field harus diisi!');window.location.href='../../pengguna/daftar.php';</script>";
    exit();
}

if ($password !== $confirm_password) {
    echo "<script type='text/javascript'>alert('Password dan konfirmasi password tidak cocok!');window.location.href='../../pengguna/daftar.php';</script>";
    exit();
}

// Validasi email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script type='text/javascript'>alert('Format email tidak valid!');window.location.href='../../pengguna/daftar.php';</script>";
    exit();
}

// Validasi panjang password
if (strlen($password) < 6) {
    echo "<script type='text/javascript'>alert('Password minimal 6 karakter!');window.location.href='../../pengguna/daftar.php';</script>";
    exit();
}

// Cek apakah email sudah terdaftar
$sql_check = "SELECT id FROM pengguna WHERE email=? LIMIT 1";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$hasil_check = $stmt_check->get_result();

if ($hasil_check->num_rows > 0) {
    echo "<script type='text/javascript'>alert('Email sudah terdaftar!');window.location.href='../../pengguna/daftar.php';</script>";
    $stmt_check->close();
    $conn->close();
    exit();
}
$stmt_check->close();

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data ke tabel pengguna
$sql = "INSERT INTO pengguna (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nama, $email, $hashed_password);

if ($stmt->execute()) {
    echo "<script type='text/javascript'>alert('Pendaftaran berhasil! Silakan login.');window.location.href='../../index.php';</script>";
} else {
    echo "<script type='text/javascript'>alert('Pendaftaran gagal!');window.location.href='../../pengguna/daftar.php';</script>";
}

$stmt->close();
$conn->close();
?>
