<?php
include __DIR__ . '/../database.php';

$id = intval($_GET['id']);
$sqlHapus = "DELETE FROM pengguna WHERE id='$id'";
$hasil = $conn->query($sqlHapus);

header('Location: ../../contern/jamaahHaji/kelola_pengguna.php');
exit;
?>
