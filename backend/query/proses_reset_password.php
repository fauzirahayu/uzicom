<?php
session_start();
include '../database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $step = $_POST['step'] ?? '';

    if ($step == 'verify') {
        // Step 1: Verifikasi akun
        $identifier = htmlspecialchars(trim($_POST['identifier']));
        $captcha = trim($_POST['captcha']);

        // Validasi input
        $errors = [];

        if (empty($identifier)) {
            $errors[] = "Email atau username tidak boleh kosong.";
        }

        // Validasi captcha
        if (!isset($_SESSION['captcha_answer']) || $captcha != $_SESSION['captcha_answer']) {
            $errors[] = "Captcha salah!";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ../../forgot_password.php');
            exit();
        }

        // Cari di tabel admin berdasarkan email atau username
        $sql_admin = "SELECT id, email, username FROM admin WHERE email = ? OR username = ? LIMIT 1";
        $stmt_admin = $conn->prepare($sql_admin);
        $stmt_admin->bind_param("ss", $identifier, $identifier);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();

        if ($result_admin->num_rows > 0) {
            $user = $result_admin->fetch_assoc();
            $_SESSION['verified_user'] = [
                'type' => 'admin',
                'id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['username']
            ];
            $stmt_admin->close();
            $conn->close();
            header('Location: ../../forgot_password.php');
            exit();
        }
        $stmt_admin->close();

        // Cari di tabel pengguna berdasarkan email atau username
        $sql_pengguna = "SELECT id, email, username FROM pengguna WHERE email = ? OR username = ? LIMIT 1";
        $stmt_pengguna = $conn->prepare($sql_pengguna);
        $stmt_pengguna->bind_param("ss", $identifier, $identifier);
        $stmt_pengguna->execute();
        $result_pengguna = $stmt_pengguna->get_result();

        if ($result_pengguna->num_rows > 0) {
            $user = $result_pengguna->fetch_assoc();
            $_SESSION['verified_user'] = [
                'type' => 'pengguna',
                'id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['username']
            ];
            $stmt_pengguna->close();
            $conn->close();
            header('Location: ../../forgot_password.php');
            exit();
        } else {
            $_SESSION['errors'] = ["Email atau username tidak ditemukan."];
        }

        $stmt_pengguna->close();
        $conn->close();
        header('Location: ../../forgot_password.php');
        exit();

    } elseif ($step == 'reset') {
        // Step 2: Reset password
        if (!isset($_SESSION['verified_user'])) {
            header('Location: ../../forgot_password.php');
            exit();
        }

        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validasi input
        $errors = [];

        if (empty($new_password)) {
            $errors[] = "Password baru tidak boleh kosong.";
        } elseif (strlen($new_password) < 6) {
            $errors[] = "Password baru minimal 6 karakter.";
        }

        if ($new_password !== $confirm_password) {
            $errors[] = "Konfirmasi password tidak cocok.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ../../forgot_password.php');
            exit();
        }

        $user = $_SESSION['verified_user'];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        if ($user['type'] == 'admin') {
            $sql_update = "UPDATE admin SET password = ? WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("si", $hashed_password, $user['id']);
        } else {
            $sql_update = "UPDATE pengguna SET password = ? WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("si", $hashed_password, $user['id']);
        }

        if ($stmt_update->execute()) {
            $_SESSION['success'] = "Password berhasil direset. Silakan login dengan password baru.";
            unset($_SESSION['verified_user']);
            $stmt_update->close();
            $conn->close();
            header('Location: ../../index.php');
            exit();
        } else {
            $_SESSION['errors'] = ["Gagal reset password."];
        }

        $stmt_update->close();
        $conn->close();
        header('Location: ../../forgot_password.php');
        exit();
    }
} else {
    header('Location: ../../index.php');
    exit();
}
?>
