<?php
include __DIR__ . '/../database.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO pengguna (username, email, password) VALUES ('$nama', '$email', '$pass_hash')";
    $hasil = $conn->query($sql);

    if ($hasil) {
        echo "<script>alert('Data berhasil disimpan!'); window.location='../../contern/jamaahHaji/tambahAdmin.php';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan!'); window.location='../../contern/jamaahHaji/tambahAdmin.php';</script>";
    }
    // Jangan redirect header setelah echo, agar alert tampil
    // exit();
} else {
    header('Location: ../../contern/jamaahHaji/tambahAdmin.php');
    exit();
}
?>