<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'car_rental_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is set in the GET request
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $vehicle_id = $_GET['id'];
} else {
    echo "Error: Vehicle ID not provided.";
    exit();
}

// Fetch vehicle details from the database
$sql = "SELECT * FROM vehicles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vehicle_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if data is found
if ($result->num_rows > 0) {
    $vehicle = $result->fetch_assoc();
} else {
    echo "No vehicle found with ID: $vehicle_id";
    exit();
}
$stmt->close();

// Ensure array indices are set before accessing
$vehicle_title = isset($vehicle['vehicle_title']) ? $vehicle['vehicle_title'] : 'N/A';
$price_per_day = isset($vehicle['price_per_day']) ? $vehicle['price_per_day'] : 'Not Available';
$overview = isset($vehicle['overview']) ? $vehicle['overview'] : 'No description available.';
$car_type = isset($vehicle['car_type']) ? $vehicle['car_type'] : 'Unknown';

// Display vehicle details (for debugging purposes)
echo "<h1>$vehicle_title</h1>";
echo "<p>Price: $price_per_day</p>";
echo "<p>Overview: $overview</p>";
echo "<p>Type: $car_type</p>";

// Google Maps integration (latitude and longitude display)
$latitude = isset($vehicle['latitude']) ? $vehicle['latitude'] : 0;
$longitude = isset($vehicle['longitude']) ? $vehicle['longitude'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Location</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzSkKnwBl3zqRDhFF3AoO62D57I0CUG5w&callback=initMap" async
        defer></script>
    <style>
        #map {
            height: 400px;
            /* Adjust the height based on the screen size */
            width: 100%;
        }

        @media (max-width: 768px) {
            #map {
                height: 300px;
                /* Smaller height for mobile screens */
            }
        }
    </style>
</head>

<body>
    <h1><?php echo $vehicle['vehicle_title']; ?> - Car Details</h1>
    <div id="map"></div>

    <script>
        function initMap() {
            const latitude = <?php echo $latitude; ?>;
            const longitude = <?php echo $longitude; ?>;

            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: latitude, lng: longitude },
                zoom: 12, // Adjust zoom level
            });

            const marker = new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: "<?php echo $vehicle['vehicle_title']; ?>"
            });
        }
    </script>
</body>

</html>