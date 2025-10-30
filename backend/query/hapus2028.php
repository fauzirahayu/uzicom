<?php
include __DIR__ . '/../database.php';

$id = intval($_GET['id']);
$sqlHapus = "DELETE FROM jamaah_2028 WHERE id='$id'";
$hasil = $conn->query($sqlHapus);

header('Location: ../../contern/jamaahHaji/jamaah2028.php');
exit;
?>