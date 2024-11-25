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
$vehicle_id = $_POST['vehicle_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Insert review
$sql_review = "INSERT INTO reviews (user_id, vehicle_id, rating, comment) VALUES (?, ?, ?, ?)";
$stmt_review = $conn->prepare($sql_review);
$stmt_review->bind_param("iiis", $user_id, $vehicle_id, $rating, $comment);

if ($stmt_review->execute()) {
    echo json_encode(["success" => "Review posted successfully"]);
} else {
    echo json_encode(["error" => "Failed to post review"]);
}
