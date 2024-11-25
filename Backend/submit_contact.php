<?php
session_start();

$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "car_rental_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and escape it for security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into contact_messages table
    $sql = "INSERT INTO contact_messages (name, phone_number, message) VALUES ('$name', '$phone_number', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Success response
        echo json_encode(["status" => "success", "message" => "Your message has been sent successfully!"]);
    } else {
        // Error response
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
}

// Close connection
$conn->close();
?>
