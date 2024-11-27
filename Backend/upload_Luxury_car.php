<?php
require_once 'db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_name = $_POST['car_name'];
    $location = $_POST['location'];
    $body_type = $_POST['body_type'];
    $fuel_type = $_POST['fuel_type'];
    $brand = $_POST['brand'];
    $price_per_day = $_POST['price_per_day'];
    $model_year = $_POST['model_year'];
    $seating_capacity = $_POST['seating_capacity'];

    // Handle uploaded images
    $uploads_dir = 'uploads/Luxury_cars/';
    
    // Check if directory exists; if not, create it
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true); // Create directory recursively
    }

    $image1 = $uploads_dir . basename($_FILES['image1']['name']);
    $image2 = $uploads_dir . basename($_FILES['image2']['name']);
    $image3 = $uploads_dir . basename($_FILES['image3']['name']);
    $image4 = $uploads_dir . basename($_FILES['image4']['name']);

    if (!move_uploaded_file($_FILES['image1']['tmp_name'], $image1)) {
        die("Error: Unable to upload Image 1.");
    }
    if (!move_uploaded_file($_FILES['image2']['tmp_name'], $image2)) {
        die("Error: Unable to upload Image 2.");
    }
    if (!move_uploaded_file($_FILES['image3']['tmp_name'], $image3)) {
        die("Error: Unable to upload Image 3.");
    }
    if (!move_uploaded_file($_FILES['image4']['tmp_name'], $image4)) {
        die("Error: Unable to upload Image 4.");
    }

    // Checkbox values (store "1" if checked, NULL if not)
    $accessories = [
        'air_conditioner' => isset($_POST['accessories']['air_conditioner']) ? 1 : NULL,
        'power_door_locks' => isset($_POST['accessories']['power_door_locks']) ? 1 : NULL,
        'abs' => isset($_POST['accessories']['abs']) ? 1 : NULL,
        'brake_assist' => isset($_POST['accessories']['brake_assist']) ? 1 : NULL,
        'power_steering' => isset($_POST['accessories']['power_steering']) ? 1 : NULL,
        'passenger_airbag' => isset($_POST['accessories']['passenger_airbag']) ? 1 : NULL,
        'driver_airbag' => isset($_POST['accessories']['driver_airbag']) ? 1 : NULL,
        'leather_seats' => isset($_POST['accessories']['leather_seats']) ? 1 : NULL,
    ];

    // SQL Insert Query
    $stmt = $conn->prepare("INSERT INTO luxury_cars 
        (car_name, location, body_type, fuel_type, brand, price_per_day, model_year, seating_capacity, image1, image2, image3, image4, air_conditioner, power_door_locks, abs, brake_assist, power_steering, passenger_airbag, driver_airbag, leather_seats) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param(
        "sssssdissssssiiiiiii",
        $car_name, $location, $body_type, $fuel_type, $brand, $price_per_day, $model_year, $seating_capacity, 
        $image1, $image2, $image3, $image4,
        $accessories['air_conditioner'], $accessories['power_door_locks'], $accessories['abs'], 
        $accessories['brake_assist'], $accessories['power_steering'], $accessories['passenger_airbag'], 
        $accessories['driver_airbag'], $accessories['leather_seats']
    );

    if ($stmt->execute()) {
        echo "Car uploaded successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
