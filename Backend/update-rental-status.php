<?php
// Database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;

    if (!$id || !$status) {
        echo "Invalid request.";
        exit;
    }

    // Validate status
    if (!in_array($status, ['confirmed', 'cancelled'])) {
        echo "Invalid status.";
        exit;
    }

    // Update rental status
    $query = "UPDATE rentals SET status = '$status' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "Rental status updated successfully.";
    } else {
        echo "Error updating rental status: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>
