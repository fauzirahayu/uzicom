<?php
    $host = 'sql310.infinityfree.com';
    $user = 'if0_40429245';
    $pass = 'fauzi4546B';   // password vPanel kamu
    $db   = 'if0_40429245_haji';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
