<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

include '../database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'];
    $nama = trim($_POST['nama']);
    $nik = trim($_POST['nik']);
    $email = trim($_POST['email']);

    // Validasi input
    $errors = [];
    if (empty($nama)) {
        $errors[] = "Nama lengkap tidak boleh kosong.";
    }
    if (empty($nik)) {
        $errors[] = "NIK tidak boleh kosong.";
    } elseif (!preg_match('/^[0-9]{16}$/', $nik)) {
        $errors[] = "NIK harus terdiri dari 16 digit angka.";
    }
     else {
        // Cek apakah NIK sudah digunakan user lain
        $sql_check_nik = "SELECT id FROM pengguna WHERE nik = ? AND id != ?";
        $stmt_check = $conn->prepare($sql_check_nik);
        $stmt_check->bind_param("si", $nik, $user_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            $errors[] = "NIK sudah digunakan oleh pengguna lain.";
        }
        $stmt_check->close();
    }
    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    } else {
        // Cek apakah email sudah digunakan user lain
        $sql_check_email = "SELECT id FROM pengguna WHERE email = ? AND id != ?";
        $stmt_check = $conn->prepare($sql_check_email);
        $stmt_check->bind_param("si", $email, $user_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            $errors[] = "Email sudah digunakan oleh pengguna lain.";
        }
        $stmt_check->close();
    }

    if (empty($errors)) {
        // Update data pengguna
        $sql_update = "UPDATE pengguna SET nama = ?, nik = ?, email = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssi", $nama,$nik , $email, $user_id);

        if ($stmt_update->execute()) {
            $_SESSION['success'] = "Profil berhasil diperbarui.";
        } else {
            $_SESSION['error'] = "Gagal memperbarui profil: " . $stmt_update->error;
        }
        $stmt_update->close();
    } else {
        $_SESSION['errors'] = $errors;
    }

    header('Location: ../../pengguna/edit_profil.php');
    exit();
}

$conn->close();
?>
