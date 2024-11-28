<?php
// Include database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $vehicle_title = $_POST['vehicle_title'];
    $brand = $_POST['brand'];
    $overview = $_POST['overview'];
    $price_per_day = $_POST['price_per_day'];
    $fuel_type = $_POST['fuel_type'];
    $model_year = $_POST['model_year'];
    $seating_capacity = $_POST['seating_capacity'];
    $car_type = $_POST['car_type'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    // Combine address for geocoding
    $address = "$street, $city, $state, $zip";

    // Use Google Maps API to get latitude and longitude
    $google_api_key = 'AIzaSyBzSkKnwBl3zqRDhFF3AoO62D57I0CUG5w';
    $geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $google_api_key;

    $response = file_get_contents($geocode_url);
    $response_data = json_decode($response, true);

    if ($response_data['status'] === 'OK') {
        $latitude = $response_data['results'][0]['geometry']['location']['lat'];
        $longitude = $response_data['results'][0]['geometry']['location']['lng'];
    } else {
        die('Error with Google Geocoding API: ' . $response_data['status']);
    }

    // Handle file uploads
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads';
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    // Upload images
    $image1 = $_FILES['image1']['name'] ?? '';
    $image2 = $_FILES['image2']['name'] ?? '';
    $image3 = $_FILES['image3']['name'] ?? '';
    $image4 = $_FILES['image4']['name'] ?? null;
    $image5 = $_FILES['image5']['name'] ?? null;

    // Helper function to upload images
    $upload_images = function ($file, $target_dir) use (&$error_message) {
        if ($file && !move_uploaded_file($_FILES[$file]['tmp_name'], $target_dir . $_FILES[$file]['name'])) {
            $error_message .= "Failed to upload $file.<br>";
            return null;
        }
        return $_FILES[$file]['name'] ?? null;
    };

    $image1 = $upload_images('image1', $target_dir);
    $image2 = $upload_images('image2', $target_dir);
    $image3 = $upload_images('image3', $target_dir);
    $image4 = $upload_images('image4', $target_dir);
    $image5 = $upload_images('image5', $target_dir);


    // Handle accessories
    $accessories = $_POST['accessories'] ?? [];
    $air_conditioner = isset($accessories['air_conditioner']) ? 1 : 0;
    $power_door_locks = isset($accessories['power_door_locks']) ? 1 : 0;
    $abs = isset($accessories['abs']) ? 1 : 0;
    $brake_assist = isset($accessories['brake_assist']) ? 1 : 0;
    $power_steering = isset($accessories['power_steering']) ? 1 : 0;
    $passenger_airbag = isset($accessories['passenger_airbag']) ? 1 : 0;
    $driver_airbag = isset($accessories['driver_airbag']) ? 1 : 0;
    $leather_seats = isset($accessories['leather_seats']) ? 1 : 0;


    // Correct SQL query with 24 placeholders
    $sql = "INSERT INTO vehicles (
    vehicle_title, brand, overview, price_per_day, fuel_type, model_year,
    seating_capacity, car_type, address, latitude, longitude, image1, image2, 
    image3, image4, image5, air_conditioner, power_door_locks, abs, brake_assist, 
    power_steering, passenger_airbag, driver_airbag, leather_seats
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters with correct types and number
    $stmt->bind_param(
        "sssssiisssssssssiiiiiiii",
        $vehicle_title,  // string
        $brand,          // string
        $overview,       // string
        $price_per_day,  // string
        $fuel_type,      // string
        $model_year,     // integer
        $seating_capacity, // integer
        $car_type,       // string
        $address,        // string
        $latitude,       // decimal (treated as string in bind_param)
        $longitude,      // decimal (treated as string in bind_param)
        $image1,         // string
        $image2,         // string
        $image3,         // string
        $image4,         // string
        $image5,         // string
        $air_conditioner, // integer
        $power_door_locks, // integer
        $abs,            // integer
        $brake_assist,   // integer
        $power_steering, // integer
        $passenger_airbag, // integer
        $driver_airbag,  // integer
        $leather_seats   // integer
    );

    if ($stmt->execute()) {
        echo "Vehicle added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>