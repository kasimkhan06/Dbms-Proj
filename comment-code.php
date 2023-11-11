<?php
    include('includes/header.php');
    include('includes/dbcon.php');
    if(isset($_POST['cmnt-btn']))
    {
        $comment = $_POST['comment'];
        $user_id = $_SESSION['auth_user']['id'];
        $property_id = $_GET['id'];
        $sql = "INSERT INTO comments (user_id, property_id, comment) VALUES ('$user_id', '$property_id', '$comment')";
        $query_run = mysqli_query($con, $sql);
        header("Location: http://localhost/Myproj/mng_property.php?id=$property_id");
    }
?>