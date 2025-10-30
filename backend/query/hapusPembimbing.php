<?php
include __DIR__ . '/../database.php';

$id = intval($_GET['id'] ?? 0);
if ($id < 1) {
    echo 'ID tidak valid.';
    exit;
}

// Ambil nama file foto untuk dihapus dari folder jika perlu
$sqlFoto = "SELECT foto FROM pembimbing_haji WHERE id='$id'";
$resFoto = $conn->query($sqlFoto);
if ($resFoto && $row = $resFoto->fetch_assoc()) {
    $foto = $row['foto'];
    if ($foto && file_exists(__DIR__ . "/../../uploads/" . $foto)) {
        unlink(__DIR__ . "/../../uploads/" . $foto);
    }
}

$sqlUpdateJamaah = "UPDATE jamaah_haji SET id_pembimbing = NULL WHERE id_pembimbing = '$id'";
$conn->query($sqlUpdateJamaah);

$sqlUpdate2027 = "UPDATE jamaah_2027 SET id_pembimbing = NULL WHERE id_pembimbing = '$id'";
$conn->query($sqlUpdate2027);

$sqlUpdate2028 = "UPDATE jamaah_2028 SET id_pembimbing = NULL WHERE id_pembimbing = '$id'";
$conn->query($sqlUpdate2028);

$sqlUpdate2029 = "UPDATE jamaah_2029 SET id_pembimbing = NULL WHERE id_pembimbing = '$id'";
$conn->query($sqlUpdate2029);

$sqlHapus = "DELETE FROM pembimbing_haji WHERE id='$id'";
$hasil = $conn->query($sqlHapus);

header('Location: ../../contern/jamaahHaji/pembimbing.php');
exit;
?>
