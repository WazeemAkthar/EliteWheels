<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Car Rental Map</title>
  <link rel="stylesheet" href="style.css" />
  <!-- Mapbox CSS -->
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet" />
</head>
<style>
  /* Basic styling */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    display: flex;
  }

  #map {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100vh;
  }

  .sidebar {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 100;
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 250px;
  }

  .sidebar h2 {
    margin-top: 0;
  }

  button {
    width: 100%;
    padding: 10px;
    background: #0073e6;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background: #005bb5;
  }
</style>

<body>

  <!-- Map Container -->
  <div id="map"></div>

  <!-- Sidebar for Location Filters -->
  <div class="sidebar">
    <h2>Find Cars in Your Location</h2>
    <select id="locationFilter">
      <option value="">Select Location</option>
      <option value="New York">New York</option>
      <option value="Los Angeles">Los Angeles</option>
      <option value="colombo">colombo</option>
      <!-- Add other locations -->
    </select>
    <button onclick="filterCarsByLocation()">Find Cars</button>
  </div>

  <!-- Mapbox and Custom JS -->
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
  <script>
    // map.js

    // Mapbox Access Token
    mapboxgl.accessToken =
      "pk.eyJ1Ijoid2F6ZWVtYWt0aGFyIiwiYSI6ImNtMnpzZGsxazBieG8yeHNqeHoyYXNrdWgifQ.jANxKxTtw-XnD7F7WsUcag";

    // Initialize the Map
    const map = new mapboxgl.Map({
      container: "map", // container ID
      style: "mapbox://styles/mapbox/streets-v11", // Map style
      center: [79.861244, 6.927079], // Starting position [lng, lat]
      zoom: 10, // Starting zoom
    });

    // Sample Data - Replace this with data from your backend
    const cars = [
      {
        id: 1,
        name: "Car A",
        location_name: "New York",
        latitude: 40.7128,
        longitude: -74.006,
        availability: true,
      },
      {
        id: 2,
        name: "Car B",
        location_name: "Los Angeles",
        latitude: 34.0522,
        longitude: -118.2437,
        availability: true,
      },
      {
        id: 3,
        name: "Car c",
        location_name: "colombo",
        latitude: 6.927079,
        longitude: 79.861244,
        availability: true,
      },
      // Add more car data as needed
    ];

    // Function to Add Car Markers to the Map
    function addCarMarkers(filteredCars) {
      // Remove existing markers before adding new ones
      document
        .querySelectorAll(".mapboxgl-marker")
        .forEach((marker) => marker.remove());

      filteredCars.forEach((car) => {
        new mapboxgl.Marker()
          .setLngLat([car.longitude, car.latitude])
          .setPopup(
            new mapboxgl.Popup().setHTML(
              `<h4>${car.name}</h4><p>${car.location_name}</p>`
            )
          ) // Optional: Add pop-up info
          .addTo(map);
      });
    }

    // Initial Load - Show All Cars
    addCarMarkers(cars);

    // Filter Cars by Selected Location
    function filterCarsByLocation() {
      const selectedLocation =
        document.getElementById("locationFilter").value;
      const filteredCars = selectedLocation
        ? cars.filter((car) => car.location_name === selectedLocation)
        : cars;

      addCarMarkers(filteredCars);

      // Optional: Center map on the first filtered car
      if (filteredCars.length > 0) {
        map.flyTo({
          center: [filteredCars[0].longitude, filteredCars[0].latitude],
          essential: true, // Ensures the animation is supported on all devices
          zoom: 12,
        });
      }
    }
  </script>
</body>

</html>