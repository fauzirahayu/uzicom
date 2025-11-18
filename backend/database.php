<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'haji';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // if ($conn) {
    //     echo 'terhubung ke server';
    // } else {
    //     echo 'gagal terhubung ke server';
    // }
?>