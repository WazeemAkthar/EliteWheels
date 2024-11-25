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

$rental_id = $_POST['rental_id'];
$user_id = $_SESSION['user_id'];

// Check if the rental belongs to the user
$sql_check = "SELECT id FROM rentals WHERE id = ? AND user_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ii", $rental_id, $user_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows === 0) {
    die(json_encode(["error" => "Unauthorized or invalid rental"]));
}

// Delete the rental
$sql_delete = "DELETE FROM rentals WHERE id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $rental_id);

if ($stmt_delete->execute()) {
    echo json_encode(["success" => "Rental canceled successfully"]);
} else {
    echo json_encode(["error" => "Failed to cancel rental"]);
}
