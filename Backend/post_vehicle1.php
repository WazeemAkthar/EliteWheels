<?php
// Start session to store success or error messages
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'car_rental_system'); // Adjust database credentials as needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $vehicle_title = $_POST['vehicle_title'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $overview = $_POST['overview'] ?? '';
    $price_per_day = $_POST['price_per_day'] ?? '';
    $fuel_type = $_POST['fuel_type'] ?? '';
    $model_year = $_POST['model_year'] ?? '';
    $seating_capacity = $_POST['seating_capacity'] ?? '';
    $car_type = $_POST['car_type'] ?? '';
    $street = trim($_POST['street'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $zip = trim($_POST['zip'] ?? '');

    // Combine address details into a single string
    $address = "address: $street, $city, $state, $zip";

    echo "Address: $address";

    // Google Maps API Key
    $google_maps_api_key = "AIzaSyBzSkKnwBl3zqRDhFF3AoO62D57I0CUG5w";

    // Construct the API URL for geocoding
    $geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $google_maps_api_key;

    // Fetch the response
    $response = file_get_contents($geocode_url);
    $data = json_decode($response, true);

    // Check if the response is valid
    if (isset($data['status']) && $data['status'] == 'OK') {
        // Get latitude and longitude from the response
        $latitude = $data['results'][0]['geometry']['location']['lat'];
        $longitude = $data['results'][0]['geometry']['location']['lng'];

        echo "Latitude: $latitude, Longitude: $longitude"; // Debugging the output
    } else {
        // Handle error if the geocoding fails
        echo "Error: Unable to get latitude and longitude from the address.";
        exit();  // Stop further execution if geocoding fails
    }



    // Initialize error handling
    $error_message = '';
    $success_message = '';

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


    // Checkbox values (store "1" if checked, NULL if not)
    $accessories = [
        'air_conditioner' => isset($_POST['accessories']['air_conditioner']) ? 1 : 0,
        'power_door_locks' => isset($_POST['accessories']['power_door_locks']) ? 1 : 0,
        'abs' => isset($_POST['accessories']['abs']) ? 1 : 0,
        'brake_assist' => isset($_POST['accessories']['brake_assist']) ? 1 : 0,
        'power_steering' => isset($_POST['accessories']['power_steering']) ? 1 : 0,
        'passenger_airbag' => isset($_POST['accessories']['passenger_airbag']) ? 1 : 0,
        'driver_airbag' => isset($_POST['accessories']['driver_airbag']) ? 1 : 0,
        'leather_seats' => isset($_POST['accessories']['leather_seats']) ? 1 : 0,
    ];

    // SQL query to insert the data into the vehicles table
    $sql = "INSERT INTO vehicles (
    vehicle_title, brand, overview, price_per_day, fuel_type, model_year, seating_capacity, car_type, 
    address, latitude, longitude, image1, image2, image3, image4, image5, 
    air_conditioner, power_door_locks, abs, brake_assist, power_steering, passenger_airbag, driver_airbag, leather_seats
) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters for the SQL query
        $stmt->bind_param(
            "sssssdissssssssiiiiiii",
            $vehicle_title,
            $brand,
            $overview,
            $price_per_day,
            $fuel_type,
            $model_year,
            $seating_capacity,
            $car_type,
            $address,
            $latitude,
            $longitude,
            $image1,
            $image2,
            $image3,
            $image4,
            $image5,
            $accessories['air_conditioner'],
            $accessories['power_door_locks'],
            $accessories['abs'],
            $accessories['brake_assist'],
            $accessories['power_steering'],
            $accessories['passenger_airbag'],
            $accessories['driver_airbag'],
            $accessories['leather_seats']
        );

        // Execute the query
        if ($stmt->execute()) {
            // Success message
            $_SESSION['success_message'] = "Vehicle posted successfully!";
        } else {
            // Error message if query fails
            $_SESSION['error_message'] = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Error: " . $conn->error;
    }
    // Debugging message to check form data
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Debugging message for geocoding response
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    // Debugging image paths
    echo "Image 1: $image1, Image 2: $image2";
    // After inserting into the database, redirect to the form page
    header("Location: ../frontend/admin/manage-cars.php");
    exit;

}
?>