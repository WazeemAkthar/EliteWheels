<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "car_rental_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if car ID is passed
if (isset($_GET['vhid'])) {
    $vhid = intval($_GET['vhid']); // Prevent SQL injection
    $query = "SELECT * FROM vehicles WHERE id = $vhid";
    $result = mysqli_query($conn, $query);
    $vehicle = mysqli_fetch_assoc($result);
    if (!$vehicle) {
        echo "Vehicle not found.";
        exit;
    }
} else {
    echo "Vehicle not found.";
    exit;
}

// Check user authentication
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
