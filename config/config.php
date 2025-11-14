<?php
    $localhost = "localhost";
    $user = "root";
    $pass = "";
    $db = "quickhelp";

    $conn = new mysqli($localhost, $user, $pass, $db);
    if ($conn->connect_error) {
        echo $conn->connect_error;
    }