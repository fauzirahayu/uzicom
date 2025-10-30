<?php
include 'backend/database.php';

$tables = ['jamaah_haji', 'jamaah_2027', 'jamaah_2028', 'jamaah_2029'];

foreach ($tables as $table) {
    $sql = "ALTER TABLE $table ADD COLUMN no_porsi VARCHAR(50) DEFAULT NULL AFTER nik";
    if ($conn->query($sql) === TRUE) {
        echo "Column no_porsi added to $table after nik successfully.<br>";
    } else {
        echo "Error adding column to $table: " . $conn->error . "<br>";
    }
}

$conn->close();
?>
