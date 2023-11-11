<?php
    if(!isset($_SESSION['authenticated']))
    {
        $_SESSION['status'] = "Login First";
        header("Location: http://localhost/Myproj/authentication/login.php");
    }
?>