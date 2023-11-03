<?php
include('includes/dbcon.php');
include('includes/header.php');

if (isset($_GET['property_id'])) {
    $property_id = $_GET['property_id'];
    $query = "SELECT* FROM LISTINGS WHERE property_id = '$property_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $row = mysqli_fetch_assoc($query_run);
        $title = $row['title'];
        $description = $row['description'];
        $img_path = $row['img_1'];
        $price = $row['price'];
        $address = $row['address'];
        $city = $row['city'];
        $state = $row['state'];
        $property_type = $row['property_type'];
        $bhk = $row['bhk'];

        $img1path = $row['img_1'];
        $img2path = $row['img_2'];
        $img3path = $row['img_3'];
    }
}
?>




<?php include('includes/footer.php') ?>