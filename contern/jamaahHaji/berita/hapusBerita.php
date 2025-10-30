<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

include '../../../backend/database.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Delete news article
    $query = "DELETE FROM berita WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: berita.php?message=Berita berhasil dihapus');
    } else {
        header('Location: berita.php?error=Gagal menghapus berita');
    }
} else {
    header('Location: berita.php?error=ID berita tidak valid');
}
exit();
?>
