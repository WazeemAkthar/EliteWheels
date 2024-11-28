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
    $street = $_POST['street'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $zip = $_POST['zip'] ?? '';

    // Combine address details into a single string
    $address = "Address: $street, $city, $state, $zip";

    // Initialize error handling
    $error_message = '';
    $success_message = '';

    // Handle file uploads
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/EliteWheels/Backend/uploads/';
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    // Upload images
    $image1 = $_FILES['image1']['name'] ?? '';
    $image2 = $_FILES['image2']['name'] ?? '';
    $image3 = $_FILES['image3']['name'] ?? '';
    $image4 = $_FILES['image4']['name'] ?? null;
    $image5 = $_FILES['image5']['name'] ?? null;

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

    // If there are no errors in file uploads, proceed to database insertion
    if (empty($error_message)) {
        $sql = "INSERT INTO vehicles (
            vehicle_title, brand, overview, price_per_day, fuel_type, model_year, seating_capacity, car_type, Address
            image1, image2, image3, image4, image5,
            air_conditioner, power_door_locks, abs, brake_assist, power_steering, passenger_airbag, driver_airbag, leather_seats
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(
                "sssssisissssssiiiiiii",
                $vehicle_title,
                $brand,
                $overview,
                $price_per_day,
                $fuel_type,
                $model_year,
                $seating_capacity,
                $car_type,
                $address,
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

            if ($stmt->execute()) {
                $success_message = "Vehicle posted successfully!";
            } else {
                $error_message .= "Database Error: " . $stmt->error . "<br>";
            }

            $stmt->close();
        } else {
            $error_message .= "Failed to prepare the SQL statement: " . $conn->error . "<br>";
        }
    }

    // Close the database connection
    $conn->close();

    // Store messages in the session and redirect back to the form
    if (!empty($success_message)) {
        $_SESSION['success_message'] = $success_message;
    }
    if (!empty($error_message)) {
        $_SESSION['error_message'] = $error_message;
    }
    header("Location: ../frontend/admin/manage-cars.php");
    exit;
}
?>