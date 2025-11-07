<?php
include __DIR__ . '/../database.php';

if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($password)) {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE pengguna SET username=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $pass_hash, $id);
    } else {
        $sql = "UPDATE pengguna SET username=?, email=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $email, $id);
    }

    if ($stmt->execute()) {
        header('Location: ../../contern/jamaahHaji/kelola_pengguna.php');
        exit;
    } else {
        echo 'Data gagal diupdate: ' . $stmt->error;
    }
}
?>
