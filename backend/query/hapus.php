<?php
include __DIR__ . '/../database.php';

$id = intval($_GET['id']);
$sqlHapus = "DELETE FROM jamaah_haji WHERE id='$id'";
$hasil = $conn->query($sqlHapus);

header('Location: ../../contern/jamaahHaji/jamaah.php');
exit;
?>