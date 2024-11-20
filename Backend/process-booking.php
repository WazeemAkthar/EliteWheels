<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to book a car.";
    http_response_code(401);
    exit;
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "car_rental_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate and sanitize input
$car_id = intval($_POST['vhid']);
$user_id = intval($_SESSION['user_id']);
$start_date = mysqli_real_escape_string($conn, $_POST['from_date']);
$end_date = mysqli_real_escape_string($conn, $_POST['to_date']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Booking logic in PHP
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $user_id = $_SESSION['user_id'];
    $car_id = intval($_POST['car_id']);
    $rental_start = $_POST['start_date'];
    $rental_end = $_POST['end_date'];

    // Fetch user name
    $user_query = "SELECT name FROM users WHERE id = $user_id";
    $user_result = mysqli_query($conn, $user_query);
    $user = mysqli_fetch_assoc($user_result);
    $user_name = $user['name'];

    // Fetch vehicle name
    $car_query = "SELECT vehicle_title FROM vehicles WHERE id = $car_id";
    $car_result = mysqli_query($conn, $car_query);
    $car = mysqli_fetch_assoc($car_result);
    $vehicle_name = $car['vehicle_title'];

    // Insert rental data
    $insert_query = "
        INSERT INTO rentals (user_id, car_id, user_name, vehicle_name, rental_start, rental_end) 
        VALUES ('$user_id', '$car_id', '$user_name', '$vehicle_name', '$rental_start', '$rental_end')
    ";
    if (mysqli_query($conn, $insert_query)) {
        echo "Booking successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>