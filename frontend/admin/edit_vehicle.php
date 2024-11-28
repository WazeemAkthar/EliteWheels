<?php
// Fetch car details by ID for editing
$id = $_GET['id'];

// Fetch the car details from the database
$sql = "SELECT * FROM vehicles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();

// Populate an edit form for updating the vehicle data
?>
