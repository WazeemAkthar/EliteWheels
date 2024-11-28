<?php
// Start session to store success or error messages
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'car_rental_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data
$vehicle_id = $_POST['vehicle_id'] ?? null;
if (!$vehicle_id) {
    die("Invalid vehicle ID.");
}

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
$address = "Address: $street, $city, $state, $zip";

// Handle file uploads (similar to add_vehicle)
$upload_image = function ($file_key) {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/EliteWheels/Backend/uploads/';
    if (isset($_FILES[$file_key]['name']) && !empty($_FILES[$file_key]['name'])) {
        $file_name = $_FILES[$file_key]['name'];
        if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $target_dir . $file_name)) {
            return $file_name;
        } else {
            return null;
        }
    }
    return null;
};

$image1 = $upload_image('image1');
$image2 = $upload_image('image2');
$image3 = $upload_image('image3');
$image4 = $upload_image('image4');
$image5 = $upload_image('image5');

// Checkbox values for accessories
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

// Update vehicle details in the database
$sql = "UPDATE vehicles SET 
            vehicle_title = ?, brand = ?, overview = ?, price_per_day = ?, fuel_type = ?, model_year = ?, seating_capacity = ?, car_type = ?, 
            address = ?, image1 = ?, image2 = ?, image3 = ?, image4 = ?, image5 = ?, 
            air_conditioner = ?, power_door_locks = ?, abs = ?, brake_assist = ?, 
            power_steering = ?, passenger_airbag = ?, driver_airbag = ?, leather_seats = ? 
        WHERE id = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param(
        "sssssisissssssiiiiiiii",
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
        $accessories['leather_seats'],
        $vehicle_id
    );

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Vehicle updated successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to update vehicle.";
    }

    $stmt->close();
} else {
    $_SESSION['error_message'] = "Error preparing SQL statement.";
}

$conn->close();

header("Location: edit-vehicle.php?id=$vehicle_id"); // Redirect to the edit form page
exit();
?>