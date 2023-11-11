<?php
$page_title = 'Property Details';
include('includes/dbcon.php');
include('includes/header.php');

function validate($value) {
    if (is_numeric($value) && is_int((int)$value)) {
      return (int)$value;
    } else {
      return null;
    }
  }
  
  if (isset($_GET['id'])) {
    if ($_GET['id'] == null) {
      header("Location: index.php");
      exit;
    }
  } else {
    header("Location: index.php");
    exit;
  }

//to check if id is set
if (isset($_GET['id'])) {
    $id = validate($_GET['id']);
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
        <div class="col text-center bg-secondary" style="font-family:Arial, Helvetica, sans-serif; font-size: x-large; font-weight: bold;" ;>
            <h4 class="p-1 m-1 text-dark">Property Details</h4>
        </div>
    </div>
</div>

<div class="mt-5 container p-1" style="height: 1000px;">
    <div class="row m-3">

        <div class="col-12 p-2" style="font-family: Arial, Helvetica, sans-serif; font-size: x-large; font-weight: bold; text-transform: capitalize; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
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
                <div class="col border border-2 border-dark m-1 p-1 d-flex d-inline" style="box-shadow: 0 4px 6px rgba(1, 0, 0, 0.533);">
                    <i class="fa-solid fa-house fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px; box-shadow: 0 4px 6px rgba(49, 49, 49, 0.407);"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo $property_type; ?></h5>
                </div>
            </div>
            <div class="row m-1 mt-2">
                <div class="col border border-2 border-dark m-1 p-1 d-flex d-inline" style="box-shadow: 0 4px 6px rgba(1, 0, 0, 0.533);">
                    <i class="fa-solid fa-building fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px; box-shadow: 0 4px 6px rgba(49, 49, 49, 0.407);"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$bhk BHK"; ?></h5>
                </div>
            </div>
            <div class="row m-1 mt-2">
                <div class="col border border-2 border-dark m-1 p-1 d-flex d-inline" style="box-shadow: 0 4px 6px rgba(1, 0, 0, 0.533);">
                    <i class="fa-solid fa-building fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px; box-shadow: 0 4px 6px rgba(49, 49, 49, 0.407);"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$total_floors FLOORS"; ?></h5>
                </div>
            </div>
            <div class="row m-1 mt-2">
                <div class="col border border-2 border-dark m-1 p-1 d-flex d-inline" style="box-shadow: 0 4px 6px rgba(1, 0, 0, 0.533);">
                    <i class="fa-solid fa-indian-rupee-sign fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px; box-shadow: 0 4px 6px rgba(49, 49, 49, 0.407);"></i>                    
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$price";; ?></h5>
                </div>
            </div>
            <div class="row m-1 mt-2">
                <div class="col border border-2 border-dark m-1 p-1 d-flex d-inline" style="box-shadow: 0 4px 6px rgba(1, 0, 0, 0.533);">
                    <i class="fa-solid fa-chart-area fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px; box-shadow: 0 4px 6px rgba(49, 49, 49, 0.407);"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$area_size sqmts";; ?></h5>
                </div>
            </div>
            <div class="row m-1 mt-2">
                <div class="col border border-2 border-dark m-1 p-1 d-flex d-inline" style="box-shadow: 0 4px 6px rgba(1, 0, 0, 0.533);">
                    <i class="fa-solid fa-location-dot fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px; box-shadow: 0 4px 6px rgba(49, 49, 49, 0.407);"></i>
                    <h5 class="p-1" style="margin-top:2px"><?php echo  "$address";; ?></h5>
                </div>
            </div>

        </div>
    </div>

    <div class="row mt-3 p-1">
        <div class="col-12 p-2">
            <div class="row m-1">

                <div class="col m-1 p-1 d-flex d-inline border border-secondary border-2" style="box-shadow: 0 4px 6px rgba(1, 0, 0, 0.533);">
                    <i class="fa-solid fa-list fa-lg p-2" style="color: #333538; margin-top:9px; margin-right:20px;"></i>
                    <h5 class="mt-1 p-2" style="margin-top:2px"><?php echo  "$description";; ?></h5>
                </div>
            </div>
        </div>
    </div>
    <?php
    //curr user
    if(isset($_SESSION['authenticed']))
    {
        $curr_user = $_SESSION['auth_user']['id'];
    }
    else
        $curr_user = -1;
    if ($user_id == $curr_user) {
        echo '
                <div class="row mt-2 p-2 ">
                    <div class="col-4">
                        <a href="http://localhost/Myproj/update_property.php?id='.$id.'" class="btn btn-secondary">Edit</a>
                        <a href="http://localhost/Myproj/update_property.php?id='.$id.'&delete=1" class="btn btn-secondary">Delete</a>
                    </div>
                </div>
            ';
    }
    echo '
                <div class="row mt-3 p-3">
                    <div class="col-10 p-1 border border-secondary border-3" style="box-shadow: 0 4px 6px rgba(1, 0, 0, 0.533);">
                        <form method ="POST" action="http://localhost/Myproj/comment-code.php?id='.$id.'">
                            <div class="form-group">
                                <i class="fa-solid fa-message fa-lg p-1 m-1" style="color: #2b2f36;"></i>
                                <label for="exampleTextarea" class="mb-2 text-dark">Comment</label>
                                <textarea class="form-control text-dark border border-dark border-2 " id="exampleTextarea" rows="5" placeholder="Comment" name="comment" style="height:15px;"></textarea>
                            </div>';
                            if(isset($_SESSION['authenticated'])) echo '<button type="submit" class="btn btn-secondary m-1 p-2" name="cmnt-btn">send</button>';
                            else echo '<button type="submit" class="btn btn-secondary m-1 p-2" disabled>send</button>
                            <br><a class="text-danger" style="text-decoration:none;" href="http://localhost/Myproj/authentication/login.php">You need to login to comment</a>';
                        echo '</form>
                    </div>
                </div>';
    ?>  
    <div class="row">
        <div class="col">
            <h4 class="p-1 m-1 text-dark">Comments</h4>
        </div>
    </div>
    <?php
        $sql = "SELECT * FROM comments WHERE property_id = '$id'";
        $query_run = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($query_run))
        {
            $user_id = $row['user_id'];
            $sql2 = "SELECT * FROM users WHERE user_id = '$user_id'";
            $query_run2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($query_run2);
            $name = $row2['name'];
            $comment = $row['comment'];
            echo '
                <div class="comment-box" >
                <div class="row mt-3 p-3">
                    <div class="col-10 p-1 border border-secondary border-2">
                        <div class="row m-1">
                            <div class="col m-1 p-1">
                                <h5 class="name" style="margin-top:2px">'.$name.'</h5>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col m-1 p-1">
                                <p class="comment">'.$comment.'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            ';
        }
    ?>
</div>
<?php include('includes/footer.php'); ?>