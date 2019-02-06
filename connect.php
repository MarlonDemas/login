<?php
    require_once('user.php');

    // Connecting to the database
    $db_server = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Checking if there is a connection
    if ($db_server->connect_error) {
        echo "Failed to connect: " . $db_server->connect_error;
    } 
?>