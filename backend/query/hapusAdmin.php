<?php
include __DIR__ . '/../database.php';

$id = intval($_GET['id'] ?? 0);
if ($id < 1) {
    echo 'ID tidak valid.';
    exit;
}

$sqlHapus = "DELETE FROM admin WHERE id='$id'";
$hasil = $conn->query($sqlHapus);

header('Location: ../../contern/jamaahHaji/kelola_akun.php');
exit;
?>
