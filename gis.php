<?php include('includes/header.php'); ?>

<div class="m-40 grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="mb-6">
            <label for="location" class="block text-lg font-bold mb-2">Property Location</label>
            <div class="relative">
                <input type="text" class="border rounded p-2 w-full" name="location"
                    placeholder="Example: Remote, Boston MA, etc" id="property-location" />
                <p class="text-red-500 text-xs font-semibold font-serif absolute left-0 -bottom-7">
                    Location is required
                </p>
            </div>
                <button type="button" name="locBut" onclick="searchLocation()" id="locBut" class="mt-4 bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                    Search Location
                </button>
        <div class="mb-6 mt-3">
            <div class="flex items-center">
                <label for="latitude" class="text-lg font-bold mb-2 mr-2">Latitude:</label>
                <input type="text" id="display-lat" name="latitude" readonly class="border rounded p-2" required>
            </div>
            <div class="flex items-center mt-2">
                <label for="longitude" class="text-lg font-bold mb-2 mr-2">Longitude:</label>
                <input type="text" id="display-lng" name="longitude" readonly class="border rounded p-2" required>
            </div>
        </div>
    </div>
    <div id="map" class="lg:max-w-3xl lg:w-full mx-auto" style="width: 100%; height: 400px;">
    </div>
</div>

<script>
        var map = L.map('map').setView([15.286691, 73.969780], 10);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    <?php
        // Connect to your database
        include('includes/dbcon.php');
        if(!$con){
            echo "error";
        }
    
        $sql = "SELECT* FROM `listings`";
        $result = mysqli_query($con, $sql);

        $properties = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $properties[] = $row;
        }
    ?>

    <?php foreach ($properties as $property): ?>
        fetch('https://nominatim.openstreetmap.org/search?format=json&q=<?php echo urlencode($property['city']); ?>')
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    var lat = data[0].lat;
                    var lon = data[0].lon;
                    console.log(lat, lon);
                    var marker = L.marker([lat, lon]).addTo(map)
                    var marker = L.marker([lat, lon]).addTo(map)
                    .bindPopup(
                        "<b><?php echo $property['title']; ?></b>" +
                        "<br/>City: <?php echo $property['city']; ?>" +
                        "<br/><a href='http://localhost/Myproj/mng_property.php?id=<?php echo $property['property_id']; ?>'><img src='<?php echo $property['img_1']; ?>' alt='Property Image' style='max-width: 100%; height: auto;'></a>"

                    ).openPopup();
                } else {
                    console.warn("Location not found for <?php echo $property['city']; ?>.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    <?php endforeach; ?>
    </script>

<?php include('includes/footer.php') ?>