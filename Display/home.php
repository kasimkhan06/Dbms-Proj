<?php
$page_title = 'Home';
include_once('../includes/dbcon.php');
include('../includes/header.php');

  $query = "SELECT * FROM listings";
  $result = mysqli_query($con, $query);

  if ($result === false) {
    die("Error Found!" . $con->error);
  }
?>

<div class="max-w-max justify-center mx-auto">
    <div class="bg-center bg-cover bg-no-repeat h-96 px-8 py-4 mx-auto my-auto mt-8 flex flex-col">
      <div class="div h-80 w-full">
        <header class="mt-16 text-center">
          <h1 class="text-6xl font-bold text-white">Find Your</h1>
          <h1 class="text-6xl font-bold text-white">Perfect Home</h1>
        </header>
        <form action="" method="get">
        <div class="flex flex-row justify-center">
          <div class="mt-8 flex">
            <div class="relative">
                <input class="border-2 border-gray-300 w-80 bg-white h-10 pl-12 pr-5 rounded-s-lg text-sm focus:outline-none" type="search" name="search" placeholder="Search" <?php if(isset($_GET['search'])){echo $_GET['search']; }?>>
                <div class="absolute inset-y-0 left-3 flex items-center">
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 21l-5-5"></path>
                    <circle cx="10.5" cy="10.5" r="7.5"></circle>
                  </svg>
                </div>
              </div>
               <button class="bg-blue-500 border-r-2 border-b-2 border-t-2 border-gray-300 h-10 hover:bg-blue-700 text-white font-bold py-1 px-4" type="submit">
                Search
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="container h-56">
    <div class="grid grid-cols-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <?php
      if(isset($_GET['search']))
      {
        $filtervalues = $con->real_escape_string($_GET['search']);
        $query1 = "SELECT * FROM listings WHERE CONCAT(title, city) LIKE '%$filtervalues%'";
        $query_run = mysqli_query($con, $query1);
        
        if(mysqli_num_rows($query_run) > 0)
        {
          foreach($query_run as $items)
          {
            ?>
            <div class="bg-white p-4 rounded-lg shadow-lg">
              <div class="relative">
                
                <?php 
                echo'<img src="'.$items['img_1'].'" class="w-full h-40 object-cover rounded-lg" alt="properties">';
                ?>
                <?php if ($items['availability'] == 0) { ?>
                  <div class="status sold absolute top-2 right-2 text-white bg-green-500 px-2 py-1 rounded-full">Available</div>
                <?php } else { ?>
                  <div class="status new absolute top-2 right-2 text-white bg-red-500 px-2 py-1 rounded-full">Not Available</div>
                <?php } ?>
              </div>
              <h4 class="mt-2 text-lg font-bold"><a href="property-detail.php?id=<?php echo $items['id']; ?>"><?php echo $items['title']; ?></a></h4>
              <p class="text-gray-600">Price: $<?php echo $items['price']; ?></p>
              <p class="text-gray-600">Property Type: $<?php echo $items['property_type']; ?></p>
              <p class="text-gray-600">BHK: $<?php echo $items['bhk']; ?></p>
              <a class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="property-detail.php?id=<?php echo $items['id']; ?>">View Details</a>
            </div>
            <?php
          }
        }
        else
        {
          ?>
            <h1 class="text-3xl font-bold text-slate-400">No result Found</h1>
          <?php
        }
      }
      else
      {
      while ($property_result = mysqli_fetch_assoc($result)) 
      {
        $id = $property_result['id'];
        $property_title = $property_result['title'];
        $delivery_type = $property_result['property_type'];
        $availablility = $property_result['availability'];
        $price = $property_result['price'];
        $property_img = $property_result['img_1'];
        $bhk = $property_result['bhk'];

    ?>
        <form action="property-details.php" method="GET">
          <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="relative">
              <img src="<?php echo $property_img; ?>" class="w-full h-40 object-cover rounded-lg" alt="properties">
              <?php if ($availablility == 0) { ?>
                <div class="status sold absolute top-2 right-2 text-white bg-green-500 px-2 py-1 rounded-full">Available</div>
              <?php } else { ?>
                <div class="status new absolute top-2 right-2 text-white bg-red-500 px-2 py-1 rounded-full">Not Available</div>
              <?php } ?>
            </div>
            <h4 class="mt-2 text-lg font-bold"><a href="property-detail.php?id=<?php echo $id; ?>"><?php echo $property_title; ?></a></h4>
            <p class="text-gray-600">Price: $<?php echo $price; ?></p>
            <p class="text-gray-600">Property Type: <?php echo $delivery_type; ?></p>
            <p class="text-gray-600">BHK: $<?php echo $bhk; ?></p>
            <a class="mt-4 inline-block bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="property-details?id=<?php echo $id ?>">View Details</a>
          </div>
        </form>
    <?php } ?>
        </div>
      </div>
      <?php } ?>
  </div>
</body>
<?php include('../includes/footer.php')?>