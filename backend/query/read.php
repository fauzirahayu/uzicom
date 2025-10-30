<?php
include __DIR__ . '/../database.php';

// Ambil semua data jamaah
$sql = 'SELECT * FROM jamaah_haji';
$tampil = $conn->query($sql);

// Hitung jumlah jamaah
$sqlJumlahJamaah = "SELECT COUNT(*) AS jumlah_jamaah FROM jamaah_haji";
$hasil = $conn->query($sqlJumlahJamaah);
$baris = $hasil->fetch_assoc();
$jumlahJamaah = $baris['jumlah_jamaah'];

// hitung jumlah jamaah 2027
$sqlJumlahJamaah2027 = "SELECT COUNT(*) AS jumlah_jamaah2027 FROM jamaah_2027";
$hasil2027 = $conn->query($sqlJumlahJamaah2027);
$baris2027 = $hasil2027->fetch_assoc();
$jumlahJamaah2027 = $baris2027['jumlah_jamaah2027'];

// hitung jumlah jamaah 2028
$sqlJumlahJamaah2028 = "SELECT COUNT(*) AS jumlah_jamaah2028 FROM jamaah_2028";
$hasil2028 = $conn->query($sqlJumlahJamaah2028);
$baris2028 = $hasil2028->fetch_assoc();
$jumlahJamaah2028 = $baris2028['jumlah_jamaah2028'];

// hitung jumlah jamaah 2029
$sqlJumlahJamaah2029 = "SELECT COUNT(*) AS jumlah_jamaah2029 FROM jamaah_2029";
$hasil2029 = $conn->query($sqlJumlahJamaah2029);
$baris2029 = $hasil2029->fetch_assoc();
$jumlahJamaah2029 = $baris2029['jumlah_jamaah2029'];
?>
