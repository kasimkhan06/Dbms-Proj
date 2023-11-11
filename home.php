<?php
    $title = 'Home';
    include_once('includes/dbcon.php');
    include('includes/header.php');

    $query = "SELECT * FROM listings";
    $result = $con->query($query);

    if ($result === false) {
        die("Error Found!" . $con->error);
    }
    ?>

    <div class="page-container1">
        <div class="hero">
            <h1>Find Your </h1>
            <h1> Perfect Home</h1>
            <form class="search-form" action="" method="get">
                <div class="search-container">
                    <svg class="search-symbol" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 21l-5-5"></path>
                        <circle cx="10.5" cy="10.5" r="7.5"></circle>
                    </svg>
                    <input class="search" name="search" placeholder="Search" id="address"></input>
                </div>
                <button class="search-button" onclick="findaddress()" type="submit">Search</button>
            </form>
        </div>
            <div class="property-grid">
                <?php
                if (isset($_GET['search'])) {
                    $filtervalues = $con->real_escape_string($_GET['search']);
                    $query1 = "SELECT * FROM listings WHERE CONCAT(property_type, city) LIKE '%$filtervalues%'";
                    $query_run = mysqli_query($con, $query1);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $items) {
                ?>
                            <div class="property-card">
                                <div class="relative">
                                    <img src="<?php echo $items['img_1']; ?>" class="w-full h-40 object-cover rounded-lg" alt="properties">
                                    <?php if ($items['available'] == 0) { ?>
                                        <div class="property-status new">Available</div>
                                    <?php } else { ?>
                                        <div class="property-status sold">Not Available</div>
                                    <?php } ?>
                                </div>
                                <h4 class="property-title">
                                    <a href="mng_property.php?id=<?php echo $items['property_id']; ?>"><?php echo $items['title']; ?></a>
                                </h4>
                                <p class="property-details">Price: $
                                    <?php echo $items['price']; ?>
                                </p>
                                <p class="property-details">Property Type:
                                    <?php echo $items['property_type']; ?>
                                </p>
                                <p class="property-details"><?php echo $items['bhk']; ?> BHK</p>
                                <a class="view-details-button"href="mng_property.php?id=<?php echo $items['property_id']; ?>">View Details</a>
                            </div>
                <?php
                        }
                    } else {
                ?>
                        <h1 class="no-result-message">No result Found</h1>
                <?php
                    }
                } else {
                    while ($property_result = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="property-card">
                            <div class="relative">
                                <img src="<?php echo $property_result['img_1']; ?>" class="w-full h-40 object-cover rounded-lg" alt="properties">
                                <?php if ($property_result['available'] == 0) { ?>
                                    <div class="property-status new">Available</div>
                                <?php } else { ?>
                                    <div class="property-status sold">Not Available</div>
                                <?php } ?>
                            </div>
                            <h4 class="property-title"><a href="mng_property.php?id=<?php echo $property_result['property_id']; ?>">
                                    <?php echo $property_result['title']; ?>
                                </a></h4>
                            <p class="property-details">Price: $
                                <?php echo $property_result['price']; ?>
                            </p>
                            <p class="property-details">Property Type:
                                <?php echo $property_result['property_type']; ?>
                            </p>
                            <p class="property-details"><?php echo $property_result['bhk']; ?> BHK</p>
                            <a class="view-details-button"href="mng_property.php?id=<?php echo $property_result['property_id']; ?>">View Details</a>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
    </div>
<?php include('includes/footer.php') ?>