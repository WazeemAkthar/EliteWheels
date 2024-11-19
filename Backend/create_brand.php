<?php
// Start the session to store success or error messages
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'car_rental_system'); // Adjust credentials as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $brand_name = trim($_POST['brand_name']); // Trim whitespace for consistency

    // Check if the brand already exists
    $check_sql = "SELECT * FROM brands WHERE brand_name = '$brand_name'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        // Brand already exists
        $_SESSION['message'] = "This brand is already in the list.";
        $_SESSION['message_type'] = "error"; // Set the message type to error
    } else {
        // Insert new brand into the database
        $insert_sql = "INSERT INTO brands (brand_name) VALUES ('$brand_name')";

        if ($conn->query($insert_sql) === TRUE) {
            // Brand created successfully
            $_SESSION['message'] = "SUCCESS: Brand Created successfully.";
            $_SESSION['message_type'] = "success"; // Set the message type to success
        } else {
            // Database error
            $_SESSION['message'] = "ERROR: Unable to create brand.";
            $_SESSION['message_type'] = "error";
        }
    }

    $conn->close();

    // Redirect back to the form page
    header('Location: ../frontend/admin/brands.php');
    exit();
}
?>