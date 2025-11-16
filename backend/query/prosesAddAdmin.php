<?php
include __DIR__ . '/../database.php';

if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    // // Validasi email format
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     echo "<script>alert('Format email tidak valid!'); window.location='../../contern/jamaahHaji/tambahAdmin.php';</script>";
    //     exit();
    // }

    // Validasi panjang password
    if (strlen($password) < 6) {
        echo "<script>alert('Password minimal 6 karakter!'); window.location='../../contern/jamaahHaji/tambahAdmin.php';</script>";
        exit();
    }

    // Cek apakah email sudah terdaftar di tabel admin
    $sql_check_admin = "SELECT id FROM admin WHERE email=? LIMIT 1";
    $stmt_check_admin = $conn->prepare($sql_check_admin);
    $stmt_check_admin->bind_param("s", $email);
    $stmt_check_admin->execute();
    $hasil_check_admin = $stmt_check_admin->get_result();

    if ($hasil_check_admin->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar sebagai admin!'); window.location='../../contern/jamaahHaji/tambahAdmin.php';</script>";
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
        echo "<script>alert('Email sudah terdaftar sebagai pengguna!'); window.location='../../contern/jamaahHaji/tambahAdmin.php';</script>";
        $stmt_check_pengguna->close();
        $conn->close();
        exit();
    }
    $stmt_check_pengguna->close();

    // Hash password
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke tabel admin
    $sql = "INSERT INTO admin (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama, $email, $pass_hash);

    if ($stmt->execute()) {
        echo "<script>alert('Admin berhasil ditambahkan!'); window.location='../../contern/jamaahHaji/kelola_akun.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan admin!'); window.location='../../contern/jamaahHaji/tambahAdmin.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../../contern/jamaahHaji/tambahAdmin.php');
    exit();
}
?>
