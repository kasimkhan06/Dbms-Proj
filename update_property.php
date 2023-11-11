<?php
    $title = "Update Property";
    include('includes/header.php');
    include('includes/dbcon.php');

    // Check if the user is logged in
    if (!isset($_SESSION['authenticated'])) {
        header('location: http://localhost/Myproj/authentication/login.php');
    }

    if(isset($_GET['delete']))
    {
        //remove the property from the database
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            //set available to 0
            $sql = "UPDATE listings SET available = 0 WHERE property_id = '$id'";
            $query_run = mysqli_query($con, $sql);
            if($query_run)
            {
                $_SESSION['status'] = "Property Deleted Successfully";
            }
            else
            {
                $_SESSION['status'] = "Property Deletion Failed";
            }
            header("Location: http://localhost/Myproj/dashboard.php");
        }
    }

    // Retrieve the property ID from the URL
    $property_id = $_GET['id'];

    // Query the database to fetch existing property data based on $property_id
    $query = "SELECT * FROM listings WHERE property_id = $property_id"; // Replace 'listings' with your actual table name
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $property_data = mysqli_fetch_assoc($result);
    } else {
        // Handle the case where the property doesn't exist or the query fails
    }

    // Check if the form is submitted
    if (isset($_POST['submit-btn'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $property_type = $_POST['property-type'];
        $bhk = $_POST['bhk'];
        $total_floors = $_POST['total-floors'];
        $price = $_POST['price'];
        $area_size = $_POST['area-size'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $address = $_POST['address'];

        // Handle image updates if necessary

        $user_id = $_SESSION['auth_user']['id'];

        $update_query = "UPDATE listings SET
            user_id = '$user_id',
            title = '$title',
            description = '$description',
            property_type = '$property_type',
            bhk = '$bhk',
            total_floors = '$total_floors',
            price = '$price',
            area_size = '$area_size',
            city = '$city',
            state = '$state',
            address = '$address'
            WHERE property_id = $property_id";

        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            $_SESSION['status'] = "Property Updated Successfully";
        } else {
            $_SESSION['status'] = "Property Update Failed";
        }
        header("Location: http://localhost/Myproj/dashboard.php");
    }
?>

<div class="container my-5 p-5 border border-secondary border-3">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center  cus-sub text-secondary">
            <h2>Update Property</h2>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12 border-bottom border-tertiary border-2 pb-1 text-dark p-3" style="font-family: sans-serif; padding-left:0;">
            <h4 style="display: inline;">Basic Information</h4>
        </div>
    </div>

    <form action="update_property.php?id=<?php echo $property_id; ?>" method="post" enctype="multipart/form-data">
        <div class="row mt-2">
            <div class="col-md-2">
                <label for="" class="p-4 mt-1 " style="margin-left:20px;font-size:15px;">Title</label>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" class="form-control text-dark m-3 border border-1 border-black " name="title" id="" value="<?php echo $property_data['title']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="" class="p-4 mt-1 "style="margin-left:20px;font-size:15px">Description</label>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <textarea type="text" class="form-control text-dark m-3 border border-1 border-black" name="description" id=""><?php echo $property_data['description']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3 pt-3">
                    <label class="input-group-text" for="inputGroupSelect01">Property Type</label>
                        <select class="form-select" id="inputGroupSelect01" name="property-type">
                            <option selected>Choose...</option>
                            <option value="Apartment" <?php echo ($property_data['property_type'] === 'Apartment') ? 'selected' : ''; ?>>Apartment</option>
                            <option value="Villa" <?php echo ($property_data['property_type'] === 'Villa') ? 'selected' : ''; ?>>Villa</option>
                            <option value="Office" <?php echo ($property_data['property_type'] === 'Office') ? 'selected' : ''; ?>>Office</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="input-group mb-3 pt-3">
                    <label class="input-group-text" for="inputGroupSelect01">BHK</label>
                        <select class="form-select" id="inputGroupSelect01" name="bhk">
                            <option selected>Choose...</option>
                            <option value="1" <?php echo ($property_data['bhk'] === '1') ? 'selected' : ''; ?>>1 BHK</option>
                            <option value="2" <?php echo ($property_data['bhk'] === '2') ? 'selected' : ''; ?>>2 BKH</option>
                            <option value="3" <?php echo ($property_data['bhk'] === '3') ? 'selected' : ''; ?>>3 BHK</option>
                            <option value="4" <?php echo ($property_data['bhk'] === '4') ? 'selected' : ''; ?>>4 BHK</option>
                            <option value="5" <?php echo ($property_data['bhk'] === '5') ? 'selected' : ''; ?>>5 BHK</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 border-bottom border-2 pb-2">
                <h5>Price And Location</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">Total Floors</span>
                    <input type="text" class="form-control border border-2 text-secondary" name="total-floors" value="<?php echo $property_data['total_floors']; ?>">
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">Price</span>
                    <input type="number" class="form-control border border-2 text-secondary" name="price" value="<?php echo $property_data['price']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">Area Size</span>
                    <input type="number"  class="form-control border border-2 text-secondary" name="area-size" value="<?php echo $property_data['area_size']; ?>">
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">City</span>
                    <input type="text" class="form-control border border-2 text-secondary" name="city" value="<?php echo $property_data['city']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">State</span>
                    <input type="text"  class="form-control border border-2 text-secondary" name="state" value="<?php echo $property_data['state']; ?>">
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">Address</span>
                    <input type="text" class="form-control border border-2 text-secondary" name="address" value="<?php echo $property_data['address']; ?>">
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-xl-2">
                <button class="btn cust-sub-btn" type="submit" name="submit-btn">
                    UPDATE
                </button>
            </div>
        </div>
    </form>
</div>

<?php include('includes/footer.php');?>
