var map = L.map('map').setView([15.525, 73.8323], 14);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

function searchLocation() {
  var locationInputId = "property-location";
  var lat = 0;
  var lng = 0;
  geocodeLocation(locationInputId, (latLng) => {
    console.log("lat" + latLng.lat);
    console.log("lng" + latLng.lng);
    var dispLt = document.getElementById("display-lat");
    var dispLn = document.getElementById("display-lng");
    dispLt.value = latLng.lat;
    dispLn.value = latLng.lng;
  })
}

'<?php include("includes/dbcon.php") ?>'


function convert() {
  // var locationInputId = 'locationInputId';
  // var location = document.getElementById(locationInputId).value;
  var location = '<?php echo json_encode($city); ?>';
  console.log(location);
  if (location) {
      fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + location)
          .then(response => response.json())
          .then(data => {
              if (data.length > 0) {
                  var lat = data[0].lat;
                  var lon = data[0].lon;
                  document.getElementById('latitudeInput').value = lat;
                  document.getElementById('longitudeInput').value = lon;
                  document.querySelector('form').submit();
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
  iconUrl: 'assets/images/icons8-house-96.png',
  iconSize: [32, 32], // Adjust the size as needed
});

var properties = [{
  name: "Paradise",
  lat: 15.272923,
  lng: 73.9583159
},
{
  name: "Oakwood Retreat",
  lat:  15.4989946, 
  lng: 73.8282141
},
{
  name: "Harmony House",
  lat:15.4039033,
  lng:74.00975207575615
},
{
  name: "Emerald Meadows",
  lat: 15.5889,
  lng: 73.9654
},
{
  name: "Ivy Cottage",
  lat: 15.2635,
  lng: 74.1088
},
{
  name: "Blue Lagoon Resort",
  lat: 15.5333,
  lng: 74.1333
},
{
  name: "Casa De Amor",
  lat: 15.4893469,
  lng: 73.964461
},
{
  name: "Golden Gate Mansion",
  lat:15.5508,
  lng:74.0462
},
{
  name:"Rosewood Retreat",
  lat: 15.716740,
  lng:73.796996
},
{
  name: "The Nest",
  lat : 15.601695432,
  lng: 73.813139838 
}
// Add more driver locations here
];

properties.forEach(property => {
  L.marker([property.lat, property.lng], {
          icon: customIcon
      }) // Use custom icon
      .addTo(map)
      .bindPopup(property.name);
});