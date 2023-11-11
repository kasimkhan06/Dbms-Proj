<body class="h-full w-full bg-grey-600">
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

$propid = validate($_GET['id']);
$query = "SELECT * FROM listings WHERE listings.property_id = '$propid' LIMIT 1";
$result = mysqli_query($con, $query);

if (!$result) {
  echo "Error Found!!!";
}

$property_result = mysqli_fetch_assoc($result);
$property_title = $property_result['title'];
$property_details = $property_result['description'];
$availability = $property_result['availability'];
$price = $property_result['price'];
$property_address = $property_result['address'];
$city = $property_result['city'];
$state = $property_result['state'];
$property_type = $property_result['property_type'];
$floor_space = $property_result['area_size'];
$bhk = $property_result['bhk'];
$total_floors = $property_result['total_floors'];

$imgquery = "SELECT img_1, img_2, img_3 FROM listings WHERE listings.property_id = '$propid'";
$result1 = mysqli_query($con, $imgquery);
if (!$result1) {
  echo "Error Found!!!";
}

$propimg = mysqli_fetch_assoc($result1);
$img_1 = $propimg['img_1'];
$img_2 = $propimg['img_2'];
$img_3 = $propimg['img_3'];
?>

<div class="py-2 bg-secondary">
  <div class="container">
    <h4 class="text-white text-center text-3xl">Property Details</h4>
  </div>
</div>


<div class="container text-center mt-8">
  <div class="row">
    <div class="col">
    </div>
    <div class="col-6">
      <h1 class="text-start text-3xl"><?php echo $property_title ?></h1>
      <div id="imageSlider" class="carousel slide mt-3" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#imageSlider" data-slide-to="0" class="active"></li>
            <li data-target="#imageSlider" data-slide-to="1"></li>
            <li data-target="#imageSlider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php
                $images = array($img_1, $img_2, $img_3); // Create an array of image URLs

                foreach ($images as $i => $image) 
                {
                    $activeClass = ($i === 0) ? 'active' : ''; // Set 'active' class for the first image
                    echo '<div class="carousel-item ' . $activeClass . '">';
                    echo '<img src="' . $image . '" class="d-block w-100" alt="Image">';
                    echo '</div>';
                }
            ?>
        </div>
        <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
      <div class="mt-6 text-start ">
        <div class="flex items-center">
          <i class="fa-solid fa-list" style="color: #020408;"></i>
          <h4 class="text-black fs-5 ml-3 mt-1">Property Details</h4>
        </div>
        <p class="p-2 my-2">
          <?php echo $property_details ?>
        </p>
        <div class="flex items-center">
          <i class="fa-solid fa-location-dot" style="color: #020408;"></i>
          <h4 class="text-black fs-5 ml-3 mt-1">Location</h4>
        </div>
        <p class="p-3 my-2 border border-1 shadow-inner">
          <?php echo $property_address ?>
          <span class="ml-1"><?php echo $city ?></span>
          <span class="ml-1"><?php echo $state ?></span>
        </p>
      </div>
    </div>
    <div class="col mt-3">
      <p class="p-2 my-2 mx-2 mt-4 border shadow-inner text-center">
        <span class="ml-3 text-green-600 text-3xl">$<?php echo $price ?></span>
      </p>

      <p class="p-2 my-2 mx-2 mt-4 border shadow-inner flex items-center">
        <span class="w-4 h-4" style="color: #020408;"><img src="../assets/images/check-square.svg" alt=""></span>
        <b class="ml-2">Availabilty - </b>
        <span class="ml-1"><?php if($availability == 0){echo "Available";} else {echo "Not Available";} ?></span>
      </p>

      <p class="p-2 my-2 mx-2 mt-4 border shadow-inner flex items-center">
        <i class="fa-solid fa-house" style="color: #020408;"></i>
        <b class="ml-2">Property - </b> <span class="ml-1"><?php echo $property_type; ?></span>
      </p>

      <p class="p-2 my-2 mx-2 mt-4 border shadow-inner flex items-center">
        <i class="fa-solid fa-house" style="color: #020408;"></i>
        <b class="ml-2">BHK - </b> <span class="ml-1"><?php echo $bhk; ?></span>
      </p>

      <p class="p-2 my-2 mx-2 mt-4 border shadow-inner flex items-center">
        <i class="fa-solid fa-house" style="color: #020408;"></i>
        <b class="ml-2">Total Floors - </b> <span class="ml-1"><?php echo $total_floors; ?></span>
      </p>

      <p class="p-2 my-2 mx-2 mt-4 border shadow-inner flex items-center">
        <span class="w-4 h-4" style="color: #020408;"><img src="../assets/images/check-square.svg" alt=""></span>
        <b class="ml-2">Floor Space - </b><span class="ml-1"><?php echo $floor_space ?></span>
      </p>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
</body>