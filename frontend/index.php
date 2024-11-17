<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EliteWheels - Home</title>
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css">
  <link rel="stylesheet" href="./assets/css/main.css" />
</head>
<style>
  /* Reset styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    color: #333;
  }

  /* Navbar Styles */
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: #0a2a43;
    color: #fff;
  }

  .navbar a {
    color: #fff;
    text-decoration: none;
    margin: 0 1rem;
    font-weight: bold;
  }

  /* Hero Carousel Styles */
  .hero-carousel {
    position: relative;
    height: 80vh;
    overflow: hidden;
  }

  .hero-carousel video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(60%);
  }

  .hero-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    text-align: center;
  }

  .hero-content h1 {
    font-size: 3rem;
    margin-bottom: 0.5rem;
  }

  .hero-content p {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
  }

  .hero-content button {
    padding: 0.8rem 1.5rem;
    background-color: #f9a826;
    border: none;
    border-radius: 5px;
    color: #0a2a43;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .hero-content button:hover {
    background-color: #e98b1c;
  }

  /* Why Choose Us Section */
  .why-choose-us {
    background-color: #f9f9f9;
    padding: 2rem;
    text-align: center;
  }

  .why-choose-us h2 {
    font-size: 2rem;
    margin-bottom: 1.5rem;
  }

  .features {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
  }

  .feature {
    background-color: #0a2a43;
    color: #fff;
    padding: 1rem;
    border-radius: 10px;
    width: 250px;
    text-align: center;
    transition: transform 0.3s ease;
  }

  .feature img {
    width: 50px;
    margin-bottom: 1rem;
  }

  .feature h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
  }

  .feature:hover {
    transform: translateY(-10px);
  }

  /* Testimonials */
  .testimonials {
    padding: 2rem;
    background-color: #0a2a43;
    color: #fff;
    text-align: center;
  }

  .testimonials h2 {
    margin-bottom: 1rem;
  }

  .testimonial {
    max-width: 500px;
    margin: 1rem auto;
    padding: 1rem;
    background-color: #f9a826;
    border-radius: 10px;
    color: #0a2a43;
  }

  /* Location and Coverage Map */
  .location-map {
    padding: 2rem;
    text-align: center;
  }

  .location-map h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
  }

  #map {
    width: 100%;
    height: 400px;
    border-radius: 10px;
    margin-top: 1rem;
  }


  /* Hero Section */
  .hero-carousel {
    position: relative;
    height: 100vh;
    overflow: hidden;
  }

  .hero-carousel video {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .hero-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #ffcd3c;
  }

  .hero-overlay h1 {
    font-size: 3em;
    font-weight: bold;
    margin-bottom: 1rem;
  }

  .hero-overlay p {
    font-size: 1.5em;
    margin-bottom: 2rem;
  }

  /* Search Bar Overlay */
  .search-bar {
    display: flex;
    gap: 1rem;
    justify-content: center;
    background: rgba(13, 13, 99, 0.8);
    /* Dark blue semi-transparent background */
    padding: 1rem;
    border-radius: 10px;
    width: 80%;
    max-width: 700px;
    margin: 0 auto;
  }

  .search-bar input[type="text"],
  .search-bar input[type="date"] {
    padding: 0.8rem;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    width: 25%;
  }

  .search-bar button {
    padding: 0.8rem 1.5rem;
    background: linear-gradient(45deg, #d4a514, #ffcd3c);
    /* Gold gradient */
    color: #0d0d63;
    font-size: 1rem;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
  }

  .search-bar button:hover {
    background: linear-gradient(45deg, #ffcd3c, #d4a514);
  }
</style>

<body>
  <?php include('./navbar.php'); ?>

  <!-- Hero Carousel Section -->
  <section class="hero-carousel">
    <video autoplay muted loop>
      <source src="./assets/images/Herovideo.mp4" type="video/mp4">
      Your browser does not support HTML video.
    </video>
    <div class="hero-content">
      <h1>Drive Your Dreams Today</h1>
      <p>Luxury and Comfort on Every Road</p>
      <!-- <button onclick="location.href='booking.html'">Book Now</button> -->
      <!-- Search Bar Section -->
      <div class="search-bar">
        <input type="text" placeholder="Enter your location" />
        <input type="date" />
        <input type="date" />
        <button>Search</button>
      </div>
    </div>
  </section>


  <!-- Why Choose Us Section -->
  <section class="why-choose-us">
    <h2>Why Choose EliteWheels?</h2>
    <div class="features">
      <div class="feature">
        <img src="./assets/icons/car_icon.png" alt="Affordable Luxury">
        <h3>Affordable Luxury</h3>
        <p>Drive premium cars without breaking the bank.</p>
      </div>
      <div class="feature">
        <img src="./assets/icons/quality.png" alt="Top Quality">
        <h3>Top Quality</h3>
        <p>All our vehicles are well-maintained and reliable.</p>
      </div>
      <div class="feature">
        <img src="./assets/icons/booking.png" alt="Convenient Booking">
        <h3>Convenient Booking</h3>
        <p>Book your car easily online with a few clicks.</p>
      </div>
    </div>
  </section>

  <!-- Customer Testimonials Section -->
  <section class="testimonials">
    <h2>What Our Customers Say</h2>
    <div class="testimonial">
      <p>"Amazing service! The car was clean and very comfortable."</p>
      <p>- John Doe</p>
    </div>
    <div class="testimonial">
      <p>"EliteWheels offers the best deals for luxury car rentals."</p>
      <p>- Sarah Williams</p>
    </div>
  </section>

  <!-- Location and Coverage Map Section -->
  <section class="location-map">
    <h2>Our Locations</h2>
    <p>Find our service centers across the country.</p>
    <div id="map" style="height: 400px;"></div>
  </section>

  <?php include('./footer.php'); ?>

  <!-- Google Maps API -->
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

  <script>
    const navLinks = document.querySelector(".nav-links");
    const hamburger = document.querySelector(".hamburger");
    const hamburgerIcon = document.querySelector(".hamburger-icon");
    const closeIcon = document.querySelector(".close-icon");

    hamburger.addEventListener("click", function () {
      if (navLinks.classList.contains("show")) {
        navLinks.classList.remove("show");
        navLinks.classList.add("hide");

        hamburgerIcon.style.display = "inline";
        closeIcon.style.display = "none";
      } else {
        navLinks.classList.remove("hide");
        navLinks.classList.add("show");

        hamburgerIcon.style.display = "none";
        closeIcon.style.display = "inline";
      }
    });
  </script>

</body>

</html>