<?php
// getCars.php

// Include database connection
require_once 'db.php';

// Set the response header to JSON
header('Content-Type: application/json');

try {
    // Prepare SQL query to fetch car data
    // Modify the SQL query based on the structure of your 'cars' table
    $query = "SELECT id, name, type, model, price_per_day, is_luxury FROM cars";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Fetch all car data
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the data in JSON format
    echo json_encode([
        'status' => 'success',
        'data' => $cars
    ]);
} catch (Exception $e) {
    // Return error message if any issue occurs
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch cars: ' . $e->getMessage()
    ]);
}
