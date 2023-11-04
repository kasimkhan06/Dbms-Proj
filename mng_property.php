<?php
$page_title = 'Property Details';
include('includes/dbcon.php');
include('includes/header.php');

//to check if id is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM listings WHERE property_id = '$id' LIMIT 1";
    $query_run = mysqli_query($con, $sql);
    if ($query_run) {
        $row = mysqli_fetch_assoc($query_run);
        $user_id = $row['user_id'];
        $title = $row['title'];
        $description = $row['description'];
        $property_type = $row['property_type'];
        $bhk = $row['bhk'];
        $total_floors = $row['total_floors'];
        $price = $row['price'];
        $area_size = $row['area_size'];
        $city = $row['city'];
        $state = $row['state'];
        $address = $row['address'];
        $img1_path = $row['img_1'];
        $img2_path = $row['img_2'];
        $img3_path = $row['img_3'];
    }
} else {
    header('location:http://localhost/Myproj/index.php');
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col text-center bg-secondary" style="font-family:Arial, Helvetica, sans-serif" ;>
            <h4 class="p-1 m-1 text-dark">Property Details</h4>
        </div>
    </div>
</div>

<div class="mt-5 container p-1" style="height: 1000px;">
    <div class="row m-3">
        <div class="col-12 border border-3 border-dark p-2" style="font-family:Arial, Helvetica, sans-serif;" ;>
            <h3 style="padding-left: 15px;"><?php echo $title ?></h3>
        </div>
    </div>
    <div class="row m-1 p-1">
        <div class="col-6 p-1">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo $img1_path; ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo $img2_path; ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo $img3_path; ?>" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-6 p-1">
            <div class="row m-1">
                <div class="col border border-3 border-dark m-1 p-1 d-flex d-inline">
                    <i class="fa-solid fa-house fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px;"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo $property_type; ?></h5>
                </div>
            </div>
            <div class="row m-1">
                <div class="col border border-3 border-dark m-1 p-1 d-flex d-inline">
                    <i class="fa-solid fa-building fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px;"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$bhk BHK"; ?></h5>
                </div>
            </div>
            <div class="row m-1">
                <div class="col border border-3 border-dark m-1 p-1 d-flex d-inline">
                    <i class="fa-solid fa-building fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px;"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$total_floors FLOORS"; ?></h5>
                </div>
            </div>
            <div class="row m-1">
                <div class="col border border-3 border-dark m-1 p-1 d-flex d-inline">
                    <i class="fa-solid fa-indian-rupee-sign fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px;"></i>
                    <h5 class="p-1 text-success" style="margin-top:2px"><?php echo  "$price";; ?></h5>
                </div>
            </div>
            <div class="row m-1">
                <div class="col border border-3 border-dark m-1 p-1 d-flex d-inline">
                    <i class="fa-solid fa-chart-area fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px;"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$area_size sqmts";; ?></h5>
                </div>
            </div>
            <div class="row m-1">
                <div class="col border border-3 border-dark m-1 p-1 d-flex d-inline">
                    <i class="fa-solid fa-location-dot fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px;"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$address";; ?></h5>
                </div>
            </div>

        </div>
    </div>

    <div class="row mt-3 p-1">
        <div class="col-12 p-2">
            <div class="row m-1">
                <div class="col border border-3 border-dark m-1 p-1 d-flex d-inline">
                    <i class="fa-solid fa-list fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px;"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$description";; ?></h5>
                </div>
            </div>
        </div>
    </div>
    <?php
    //curr user
    $curr_user = $_SESSION['auth_user']['id'];
    if ($user_id == $curr_user) {
        echo '
                <div class="row mt-2 p-2 ">
                    <div class="col-4">
                        <a href="http://localhost/Myproj/update_property.php?id='.$id.'" class="btn btn-secondary">Edit</a>
                        <a href="http://localhost/Myproj/update_property.php?id='.$id.'&delete=1" class="btn btn-secondary">Delete</a>
                    </div>
                </div>
            ';
    } else {
        echo '
                <div class="row mt-3 p-3">
                    <div class="col-10 p-1 border border-secondary border-3">
                        <form>
                            <div class="form-group">
                                <label for="exampleTextarea" class="m-2 p-1 text-dark font-weight-bold">Message Area</label>
                                <textarea class="form-control text-dark" id="exampleTextarea" rows="5" placeholder="Enter The message Here"></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary cust-btn m-3 p-2">send message</button>
                        </form>
                    </div>
                </div>
            ';
    }
    ?>
</div>





<?php include('includes/footer.php'); ?>