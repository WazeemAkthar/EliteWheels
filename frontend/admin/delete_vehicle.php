<?php
// Get the car ID
$id = $_POST['id'];

// Delete the car from the database
$sql = "DELETE FROM vehicles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Vehicle deleted successfully.";
    header("Location: luxury_cars.php"); // Redirect back to the luxury cars page
    exit;
} else {
    echo "Error deleting vehicle.";
}
?>
