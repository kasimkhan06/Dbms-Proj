var map = L.map('map').setView([15.2993, 74.1240], 11);

mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: 'Leaflet &copy; ' + mapLink + ', contribution',
    maxZoom: 18
}).addTo(map);

var geocoder = L.Control.Geocoder.nominatim();

function getCurrentLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLat = position.coords.latitude;
            var userLng = position.coords.longitude;

            // Use reverse geocoding to get the textual location for the current location
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${userLat}&lon=${userLng}`)
                .then(response => response.json())
                .then(data => {
                    if (data.display_name) {
                        var userLocationText = data.display_name;
                        document.getElementById('your-location').value = userLocationText;
                    } else {
                        alert("Current location not found.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    } else {
        alert("Geolocation is not available in your browser.");
    }
}

function geocodeLocation(locationInputId, callback) {
    var location = document.getElementById(locationInputId).value;
    console.log(location);
    if (location) {
        // Use geocoding to get coordinates for the entered location
        fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + location)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    var lat = data[0].lat;
                    var lon = data[0].lon;
                    var latLng = L.latLng(lat, lon);
                    callback(latLng);
                } else {
                    alert("Location not found.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    } else {
        alert("Please enter a location.");
    }
}
var customIcon = L.icon({
    iconUrl: 'bike.png',
    iconSize: [32, 32], // Adjust the size as needed
});

var drivers = [{
        name: "Margao Drivers",
        lat: 15.272923, // Margao coordinates
        lng: 73.9583159
    },
    {
        name: "Panaji Drivers",
        lat:  15.4989946, // Panaji coordinates
        lng: 73.8282141
    },
    {
        name: "Ponda Drivers",
        lat:15.4039033, // Ponda coordinates
        lng:74.00975207575615
    },
    {
        name: "Bicholim Drivers",
        lat: 15.5889,
        lng: 73.9654
    },
    {
        name: "Curchorem Drivers",
        lat: 15.2635,
        lng: 74.1088
    },
    {
        name: "Valpoi Drivers",
        lat: 15.5333,
        lng: 74.1333
    },
    {
        name: "Banastarim Drivers",
        lat: 15.4893469,
        lng: 73.964461
    },
    {
        name: "Sanquelim Drivers",
        lat:15.5508,
        lng:74.0462
    },
    {
        name:"Pernem Drivers",
        lat: 15.716740,
        lng:73.796996
    },
    {
        name: "Mapusa Drivers",
        lat : 15.601695432,
        lng: 73.813139838 
    }
    // Add more driver locations here
];

drivers.forEach(driver => {
    L.marker([driver.lat, driver.lng], {
            icon: customIcon
        }) // Use custom icon
        .addTo(map)
        .bindPopup(driver.name); // Display driver name as a popup
});

function findNearestDriver(passengerLocation, availableDrivers) {
    let nearestDriver = null;
    let minDistance = Number.MAX_VALUE;

    availableDrivers.forEach(driver => {
        const distance = calculateDistance(passengerLocation, {
            lat: driver.lat,
            lng: driver.lng
        });
        if (distance < minDistance) {
            minDistance = distance;
            nearestDriver = driver;
        }
    });

    return nearestDriver;
}

function calculateDistance(pointA, pointB) {
    const lat1 = pointA.lat;
    const lon1 = pointA.lng;
    const lat2 = pointB.lat;
    const lon2 = pointB.lng;

    // Use a formula like Haversine to calculate distance
    // Implement the formula or use a library like Turf.js for this purpose
    // Example: const distance = turf.distance([lon1, lat1], [lon2, lat2]);
    // For simplicity, you can use a library like Turf.js for accurate distance calculation
    return Math.sqrt(Math.pow(lat1 - lat2, 2) + Math.pow(lon1 - lon2, 2));
}

// Call this function when a passenger requests a ride
// Call this function when a passenger requests a ride
function requestRide() {
geocodeLocation('your-location', function(yourLocationLatLng) {
// Find the nearest driver to the passenger's location
var nearestDriver = findNearestDriver(yourLocationLatLng, drivers);

if (nearestDriver) {
    // Get the passenger's destination
    geocodeLocation('destination', function(destinationLatLng) {
        // Calculate the route from the passenger's location to the destination using Leaflet Routing Machine
        var passengerControl = L.Routing.control({
            waypoints: [
                L.latLng(yourLocationLatLng.lat, yourLocationLatLng.lng), // Passenger's location
                L.latLng(destinationLatLng.lat, destinationLatLng.lng) // Destination
            ],
            routeWhileDragging: true,
            reverseWaypoints: true,
            showAlternatives: false, // Display alternative routes
        }).on('routesfound', function (e) {
            var routes = e.routes;
            console.log("Passenger routes:", routes);
        });

        // Add the passenger's route control to the map
        passengerControl.addTo(map);

        // Simulate the driver moving to the passenger's location
        updateDriverLocation(yourLocationLatLng.lat, yourLocationLatLng.lng);

        // Calculate the route from the nearest driver's location to the passenger's location using Leaflet Routing Machine
        var driverControl = L.Routing.control({
            waypoints: [
                L.latLng(nearestDriver.lat, nearestDriver.lng), // Nearest driver's location
                L.latLng(yourLocationLatLng.lat, yourLocationLatLng.lng) // Passenger's location
            ],
            routeWhileDragging: true,
            reverseWaypoints: true,
            showAlternatives: false, // Display alternative routes
            lineOptions: {
                styles: [{ color: 'blue', opacity: 0.5, weight: 5 }] // Set a custom color for the driver's route
}
        }).on('routesfound', function (e) {
            var routes = e.routes;
            console.log("Driver routes:", routes);
        });

        // Add the driver's route control to the map
        driverControl.addTo(map);
    });
} else {
    alert("No available drivers found.");
}
});
}



// Initialize the driver marker
var driverMarker = L.marker([0, 0]).addTo(map);

// Update the driver's location
function updateDriverLocation(lat, lng) {
    driverMarker.setLatLng([lat, lng]);
}

// Update the driver's route
function updateDriverRoute(startLatLng, endLatLng, callback) {
// Implement your routing logic here or use a routing service
// For simplicity, you can use Leaflet Routing Machine for route calculation
L.Routing.control({
    waypoints: [
        startLatLng,
        endLatLng
    ],
    geocoder: geocoder,
    routeWhileDragging: true,
    reverseWaypoints: true,
    showAlternatives: false
}).on('routesfound', function(e) {
    var routes = e.routes;
    console.log(routes);

    // Trigger the callback function once the route is calculated
    if (callback && typeof callback === 'function') {
        callback();
    }
}).addTo(map);
}

// Move the driver's marker along the route
function moveDriverMarkerAlongRoute(marker, startLatLng, endLatLng) {
    var polyline = L.polyline([startLatLng, endLatLng], { color: 'blue' }).addTo(map);

    // Use the L.Path.Transform library to animate the marker along the route
    var path = L.Path.Transform(polyline, {});
    marker.setLatLng(startLatLng);

    // Animate the marker
    path.animateAlong(10000, { duration: 5000 }); // Adjust duration as needed
}

function getDirections() {
    geocodeLocation('your-location', function(yourLocationLatLng) {
        geocodeLocation('destination', function(destinationLatLng) {
            console.log(yourLocationLatLng);
            console.log(destinationLatLng);

            // Use L.Routing.control from the Leaflet Routing Machine plugin
            L.Routing.control({
                waypoints: [
                    yourLocationLatLng, // Current location
                    destinationLatLng // Destination location
                ],
                geocoder: geocoder, // Use the geocoder you initialized
                routeWhileDragging: true,
                reverseWaypoints: true,
                showAlternatives: false
            }).addTo(map);
        });
    });
}
// Inside the "bookRide" function
// Inside the "bookRide" function
function bookRide() {
geocodeLocation('your-location', function (yourLocationLatLng) {
geocodeLocation('destination', function (destinationLatLng) {
    // Find the nearest driver to the passenger's location
    var nearestDriver = findNearestDriver(yourLocationLatLng, drivers);

    // Check if a nearest driver is found
    if (nearestDriver) {
        // Calculate the route from the passenger's location to the destination using Leaflet Routing Machine
        var passengerControl = L.Routing.control({
            waypoints: [
                L.latLng(yourLocationLatLng.lat, yourLocationLatLng.lng), // Passenger's location
                L.latLng(destinationLatLng.lat, destinationLatLng.lng) // Destination
            ],
            routeWhileDragging: true,
            reverseWaypoints: true,
            showAlternatives: true, // Display alternative routes
        }).on('routesfound', function (e) {
            var routes = e.routes;
            var shortestDistance = getShortestDistance(routes); // Calculate the shortest distance

            // Construct the URL for the other PHP file (e.g., booking.php) with the nearest driver's coordinates as query parameters
            var bookingUrl = 'booking.php?driver_lat=' + nearestDriver.lat + '&driver_lng=' + nearestDriver.lng;

            // Redirect to the other PHP file
            window.location.href = bookingUrl + '&driver_lat=' + yourLocationLatLng.lat + '&driver_lng=' + yourLocationLatLng.lng;

        });

        // Add the passenger's route control to the map
        passengerControl.addTo(map);
    } else {
        alert("No available drivers found.");
    }
});
});
}



// Function to redirect to the nearest drivers page with the distance as a query parameter
function redirectToNearestDrivers(distance) {
// Construct the URL for the nearest_drivers.php page with the distance as a query parameter
var url = 'nearest_drivers.php?distance=' + distance;

// Redirect to the new page
window.location.href = url;
}


function getShortestDistance(routes) {
// Calculate the shortest distance from the routes
var shortestDistance = Number.MAX_VALUE;
routes.forEach(function (route) {
if (route.summary.totalDistance < shortestDistance) {
    shortestDistance = route.summary.totalDistance;
}
});
return shortestDistance;
}

function redirectToFareCalculationPage(distance) {
// Redirect to the fare calculation page with the distance as a query parameter
window.location.href = 'fare_calculation.php?distance=' + distance;
}

