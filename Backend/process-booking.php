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

// Insert booking into database
$query = "INSERT INTO bookings (car_id, user_id, start_date, end_date, message) 
          VALUES ($car_id, $user_id, '$start_date', '$end_date', '$message')";
if (mysqli_query($conn, $query)) {
    echo "Booking successful!";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
