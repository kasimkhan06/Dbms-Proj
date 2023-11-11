<?php
    $title = "List Property";
    include('includes/header.php');
    include('includes/dbcon.php');

    // Check if the user is logged in
    if (!isset($_SESSION['authenticated'])) {
        header('location: http://localhost/Myproj/authentication/login.php');
    }
    if(isset($_POST['submit-btn']))
    {
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

        $img1path = "property/" . uniqid() . "_" .$_FILES['img-1']['name'];
        $img2path = "property/" . uniqid() . "_" .$_FILES['img-2']['name'];
        $img3path = "property/" . uniqid() . "_" .$_FILES['img-3']['name'];
        $available = 1;

        //to check if all fields are filled
        if(empty($title) || empty($description) || empty($property_type) || empty($bhk) || empty($total_floors) || empty($price) || empty($area_size) || empty($city) || empty($state) || empty($address) || empty($img1path) || empty($img2path) || empty($img3path)){
            echo "<script>alert('Please fill all the fields')</script>";
        }
                move_uploaded_file($_FILES['img-1']['tmp_name'], $img1path);
                move_uploaded_file($_FILES['img-2']['tmp_name'], $img2path);
                move_uploaded_file($_FILES['img-3']['tmp_name'], $img3path);

                $user_id = $_SESSION['auth_user']['id'];

                $query = "INSERT INTO listings (user_id, title, description, property_type, bhk, total_floors, price, area_size, city, state, address, img_1, img_2, img_3) VALUES ('$user_id', '$title', '$description', '$property_type', '$bhk', '$total_floors', '$price', '$area_size', '$city', '$state', '$address', '$img1path', '$img2path', '$img3path')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    echo "<script>alert('Property Listed Successfully')</script>";
                } else {
                    echo "<script>alert('Property Listing Failed')</script>";
                }
    }
?>

<div class="container my-5 p-5 border border-secondary border-3">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center  cus-sub text-secondary">
            <h2>Submit Property</h2>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12 border-bottom border-tertiary border-2 pb-1 text-dark p-3" style="font-family: sans-serif; padding-left:0;">
            <h4 style="display: inline;">Basic Information</h4>
        </div>
    </div>

    <form action="list.php" method="post" enctype="multipart/form-data">
        <div class="row mt-2">
            <div class="col-md-2">
                <label for="" class="p-4 mt-1 " style="margin-left:20px;font-size:15px;">Title</label>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" class="form-control text-dark m-3 border border-1 border-black " name="title" id="" placeholder="Enter Title">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="" class="p-4 mt-1 "style="margin-left:20px;font-size:15px">Description</label>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <textarea type="text" class="form-control text-dark m-3 border border-1 border-black" name="description" id="" placeholder="Enter Description"></textarea
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3 pt-3">
                    <label class="input-group-text" for="inputGroupSelect01">Property Type</label>
                        <select class="form-select" id="inputGroupSelect01" name="property-type">
                            <option selected>Choose...</option>
                            <option value="Apartment">Apartment</option>
                            <option value="Villa">Villa</option>
                            <option value="Office">Office</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="input-group mb-3 pt-3">
                    <label class="input-group-text" for="inputGroupSelect01">BHK</label>
                        <select class="form-select" id="inputGroupSelect01" name="bhk">
                            <option selected>Choose...</option>
                            <option value="1">1 BHK</option>
                            <option value="2">2 BKH</option>
                            <option value="3">3 BHK</option>
                            <option value="4">4 BHK</option>
                            <option value="5">5 BHK</option>
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
                    <input type="text" class="form-control border border-2 text-secondary" name="total-floors">
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">Price</span>
                    <input type="number" class="form-control border border-2 text-secondary" name="price">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">Area Size</span>
                    <input type="number"  class="form-control border border-2 text-secondary" name="area-size">
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">City</span>
                    <input type="text" class="form-control border border-2 text-secondary" name="city">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">State</span>
                    <input type="text"  class="form-control border border-2 text-secondary" name="state">
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="input-group">
                    <span class="input-group-text">Address</span>
                    <input type="text" class="form-control border border-2 text-secondary" name="address">
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 p-2 border-bottom border-tertiary mb-3">
                <h4>Image & Status</h4>
            </div>
        </div>
        <div class="row p-1 text-center">
            <div class="col-md-1 p-1">
                <label for="">Image 1</label>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="file" class="form-control border border-2 border-tertiary text-black" id="inputGroupFile02" name="img-1">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
        </div>
        <div class="row p-1 text-center">
            <div class="col-md-1 p-1">
                <label for="">Image 2</label>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="file" class="form-control border border-2 border-tertiary text-black" id="inputGroupFile02" name="img-2">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
        </div>
        <div class="row p-1 text-center">
            <div class="col-md-1 p-1">
                <label for="">Image 3</label>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="file" class="form-control border border-2 border-tertiary text-black" id="inputGroupFile02" name="img-3">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-xl-2">
                <button class="btn cust-sub-btn" type="submit" name="submit-btn">
                    SUBMIT
                </button>
            </div>
        </div>
    </form>
</div>

<?php include('includes/footer.php'); ?>