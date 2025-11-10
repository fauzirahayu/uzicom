<?php
// mengaktifkan session
session_start();

include __DIR__ . '/../database.php';

$nama = htmlspecialchars(trim($_POST['nama']));
$email = htmlspecialchars(trim($_POST['email']));
$nik = htmlspecialchars(trim($_POST['nik']));
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validasi input
if (empty($nama) || empty($email) || empty($nik) || empty($password) || empty($confirm_password)) {
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

// Validasi NIK (harus 16 digit angka)
if (!preg_match('/^[0-9]{16}$/', $nik)) {
    echo "<script type='text/javascript'>alert('NIK harus 16 digit angka!');window.location.href='../../pengguna/daftar.php';</script>";
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

// Cek apakah NIK sudah terdaftar
$sql_check_nik = "SELECT id FROM pengguna WHERE nik=? LIMIT 1";
$stmt_check_nik = $conn->prepare($sql_check_nik);
$stmt_check_nik->bind_param("s", $nik);
$stmt_check_nik->execute();
$hasil_check_nik = $stmt_check_nik->get_result();

if ($hasil_check_nik->num_rows > 0) {
    echo "<script type='text/javascript'>alert('NIK sudah terdaftar!');window.location.href='../../pengguna/daftar.php';</script>";
    $stmt_check_nik->close();
    $conn->close();
    exit();
}
$stmt_check_nik->close();

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data ke tabel pengguna
$sql = "INSERT INTO pengguna (username, email, nik, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $email, $nik, $hashed_password);

if ($stmt->execute()) {
    echo "<script type='text/javascript'>alert('Pendaftaran berhasil! Silakan login.');window.location.href='../../index.php';</script>";
} else {
    echo "<script type='text/javascript'>alert('Pendaftaran gagal!');window.location.href='../../pengguna/daftar.php';</script>";
}

$stmt->close();
$conn->close();
?>
