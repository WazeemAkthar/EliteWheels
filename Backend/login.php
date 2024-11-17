<?php
header('Content-Type: application/json');

// Database credentials
$host = 'localhost';
$dbname = 'car_rental_system';
$username = 'root';
$password = '';

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed"]));
}

// Get the POST data
$user = $_POST['username'];
$pass = $_POST['password'];

// Sanitize input
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Query to find the user
$sql = "SELECT role, password FROM users WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify the password (assuming MD5 encryption)
    if (md5($pass) === $row['password']) {
        echo json_encode(["status" => "success", "role" => $row['role']]);
    } else {
        echo json_encode(["status" => "error", "message" => "Incorrect password"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "User not found"]);
}

$conn->close();
?>