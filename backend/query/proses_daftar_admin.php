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
    echo "<script type='text/javascript'>alert('Semua field harus diisi!');window.location.href='../../contern/jamaahHaji/daftarAdmin.php';</script>";
    exit();
}

if ($password !== $confirm_password) {
    echo "<script type='text/javascript'>alert('Password dan konfirmasi password tidak cocok!');window.location.href='../../contern/jamaahHaji/daftarAdmin.php';</script>";
    exit();
}

// Validasi email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script type='text/javascript'>alert('Format email tidak valid!');window.location.href='../../contern/jamaahHaji/daftarAdmin.php';</script>";
    exit();
}

// Validasi panjang password
if (strlen($password) < 6) {
    echo "<script type='text/javascript'>alert('Password minimal 6 karakter!');window.location.href='../../contern/jamaahHaji/daftarAdmin.php';</script>";
    exit();
}

// Cek apakah email sudah terdaftar di tabel admin
$sql_check_admin = "SELECT id FROM admin WHERE email=? LIMIT 1";
$stmt_check_admin = $conn->prepare($sql_check_admin);
$stmt_check_admin->bind_param("s", $email);
$stmt_check_admin->execute();
$hasil_check_admin = $stmt_check_admin->get_result();

if ($hasil_check_admin->num_rows > 0) {
    echo "<script type='text/javascript'>alert('Email sudah terdaftar sebagai admin!');window.location.href='../../contern/jamaahHaji/daftarAdmin.php';</script>";
    $stmt_check_admin->close();
    $conn->close();
    exit();
}
$stmt_check_admin->close();

// Cek apakah email sudah terdaftar di tabel pengguna
$sql_check_pengguna = "SELECT id FROM pengguna WHERE email=? LIMIT 1";
$stmt_check_pengguna = $conn->prepare($sql_check_pengguna);
$stmt_check_pengguna->bind_param("s", $email);
$stmt_check_pengguna->execute();
$hasil_check_pengguna = $stmt_check_pengguna->get_result();

if ($hasil_check_pengguna->num_rows > 0) {
    echo "<script type='text/javascript'>alert('Email sudah terdaftar sebagai pengguna!');window.location.href='../../contern/jamaahHaji/daftarAdmin.php';</script>";
    $stmt_check_pengguna->close();
    $conn->close();
    exit();
}
$stmt_check_pengguna->close();

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data ke tabel pengguna
$sql = "INSERT INTO admin (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nama, $email, $hashed_password);

if ($stmt->execute()) {
    echo "<script type='text/javascript'>alert('Pendaftaran admin berhasil! Silakan login.');window.location.href='../../index.php';</script>";
} else {
    echo "<script type='text/javascript'>alert('Pendaftaran gagal!');window.location.href='../../daftarAdmin.php';</script>";
}

$stmt->close();
$conn->close();
?>
