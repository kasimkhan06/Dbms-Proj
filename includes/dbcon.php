<?php

    $con = new mysqli("localhost" , "root" , "" , "realestate");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
?>