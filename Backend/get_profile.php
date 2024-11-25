<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die(json_encode(["error" => "User not logged in"]));
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}

$user_id = $_SESSION['user_id'];

// Fetch user profile
$sql_user = "SELECT name, email FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user_data = $result_user->fetch_assoc();

// Fetch rented vehicles
$sql_rentals = "SELECT 
                    r.id AS rental_id,
                    v.vehicle_title,
                    v.brand,
                    r.rental_start,
                    r.rental_end,
                    r.status,
                    DATEDIFF(r.rental_end, CURDATE()) AS days_left
                FROM rentals r
                JOIN vehicles v ON r.car_id = v.id
                WHERE r.user_id = ?";
$stmt_rentals = $conn->prepare($sql_rentals);
$stmt_rentals->bind_param("i", $user_id);
$stmt_rentals->execute();
$result_rentals = $stmt_rentals->get_result();

$rentals = [];
while ($row = $result_rentals->fetch_assoc()) {
    $rentals[] = $row;
}

// Return JSON response
echo json_encode([
    "user" => $user_data,
    "rentals" => $rentals
]);
