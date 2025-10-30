<?php
include __DIR__ . '/../database.php';

$id = intval($_GET['id']);
$sqlHapus = "DELETE FROM jamaah_2029 WHERE id='$id'";
$hasil = $conn->query($sqlHapus);

header('Location: ../../contern/jamaahHaji/jamaah2029.php');
exit;
?>