<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die(json_encode(["error" => "User not logged in"]));
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}

$user_id = $_SESSION['user_id'];
$new_password = $_POST['password'];

// Update password
$sql_update = "UPDATE users SET password = ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
$stmt_update->bind_param("si", $hashed_password, $user_id);

if ($stmt_update->execute()) {
    echo json_encode(["success" => "Password updated successfully"]);
} else {
    echo json_encode(["error" => "Failed to update password"]);
}
