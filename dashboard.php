
<?php 
$title = 'Dashboard';
include('includes/header.php'); 
?>

<style>
    .user-info {
        display: flex;
        align-items: center;
    }

    .user-info img {
        width: 100px;
        height: 100px; 
        margin-right: 20px; 
        margin-left: 20px;
    }

    .list-group {
        list-style: none;
    }


<?php include('includes/header.php'); include('includes/authentication.php')?>

<div class="mt-2 mb-5 container p-5 " style="height: 1000px;">

    <div class="row y p-2 text-center">
        <div class="col-12 p-1">
            <h1 class="pb-2 border-bottom d-inline border-secondary" style="font-family:Arial, Helvetica, sans-serif; font-size: xx-large;">Dashboard</h1>
        </div>
    </div>
  
    <div class="mt-3 row justify-content-center">
            <div class="col-md-12 text-center ">
                <?php
                if (isset($_SESSION['status'])) {
                ?>
                    <div class="alert transparent-alert border-0">
                        <h5 class="text-white">
                            <?= $_SESSION['status']; ?>
                        </h5>
                    </div>
                <?php
                    unset($_SESSION['status']);
                }
                ?>
            </div>
        </div>
    <div class="mt-1 row p-2">

        <div class="col-4 p-1">
            <div class="card" style="width: 25rem;">
                <div class="card-header">
                    <h4>Account Details</h4>
                </div>
                <div class="user-info">
                    <img src="assets/images/60111.jpg" alt="User Avatar" class="user_avatar">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $_SESSION['auth_user']['username'] ?></li>
                        <li class="list-group-item"><?php echo $_SESSION['auth_user']['phone'] ?></li>
                        <li class="list-group-item"><?php echo $_SESSION['auth_user']['email'] ?></li>
                    </ul>
                </div>                
            </div>
        </div>
    </div>

    <div class="mt-3 row  p-2">
        <div class="col-4 p-1">
            <h1 class="pb-1 d-inline border-secondary" style="font-family:Arial, Helvetica, sans-serif; border-bottom: 3px solid ;">MY LISTINGS</h1>
        </div>
    </div>

    <!-- php code to get all the listings of the user -->
    

    <div class="row mt-1  p-2">
        <?php
            include('includes/dbcon.php');
            $user_id = $_SESSION['auth_user']['id'];
            $sql = "SELECT * FROM listings WHERE user_id = '$user_id'";
            $query_run = mysqli_query($con, $sql);
            
            if($query_run)
            {
                $cnt = 0;
                while(($row = mysqli_fetch_assoc($query_run)) && $cnt < 3)
                {   
                    $available = $row['available'];
                    if($available == 0)
                    {
                        continue;
                    }
                    $cnt = $cnt + 1;
                    $title = $row['title'];
                    $description = $row['description'];
                    $img_path = $row['img_1'];
                    $id = $row['property_id'];
                    echo '
                        <div class="col-3 p-1" style="margin:2px 5px 2px 0px ;">
                            <div class="card border border-3 border-tertiary" style="width: 18rem;">
                                <img src="'.$img_path.'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">'.$title.'</h5>
                                    <p class="card-text">'.$description.'</p>
                                    <a href="http://localhost/Myproj/mng_property.php?id='.$id.'" class="btn btn-secondary">View Details</a>
                                </div>
                            </div>
                         </div>
                    ';
                }
                if($cnt>3)
                {
                    echo '
                        <div class="row mt-2 p-2">
                            <div class="col-md-2 p-2">
                                <button type="button" class="btn btn-secondary">View All</button>
                            </div>
                        </div>
                    ';
                }
            }

        ?>
    </div>

</div>

<?php include('includes/footer.php') ?>