<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

include '../database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Validasi input
    $errors = [];

    if (empty($password_lama)) {
        $errors[] = "Password lama tidak boleh kosong.";
    }

    if (empty($password_baru)) {
        $errors[] = "Password baru tidak boleh kosong.";
    } elseif (strlen($password_baru) < 6) {
        $errors[] = "Password baru minimal 6 karakter.";
    }

    if ($password_baru !== $konfirmasi_password) {
        $errors[] = "Konfirmasi password tidak cocok.";
    }

    if (empty($errors)) {
        // Ambil password lama dari database
        $sql = "SELECT password FROM pengguna WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password_lama, $user['password'])) {
            // Password lama benar, update dengan password baru
            $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
            $sql_update = "UPDATE pengguna SET password = ? WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("si", $password_hash, $user_id);

            if ($stmt_update->execute()) {
                $_SESSION['success'] = "Password berhasil diperbarui.";
            } else {
                $_SESSION['error'] = "Gagal memperbarui password: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            $errors[] = "Password lama tidak benar.";
        }
        $stmt->close();
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    }

    header('Location: ../../pengguna/ubah_password.php');
    exit();
}

$conn->close();
?>
