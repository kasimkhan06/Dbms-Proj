<?php
    if(isset($_SESSION['authenticated']))
    {
        $_SESSION['status'] = "Already Logged In";
        header("Location: http://localhost/Myproj/index.php");
    }
    else
    {
        
    }
?>