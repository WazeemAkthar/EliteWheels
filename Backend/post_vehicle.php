<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'car_rental_system'); // Adjust as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $vehicle_title = $_POST['vehicle_title'];
    $brand = $_POST['brand'];
    $overview = $_POST['overview'];
    $price_per_day = $_POST['price_per_day'];
    $fuel_type = $_POST['fuel_type'];
    $model_year = $_POST['model_year'];
    $seating_capacity = $_POST['seating_capacity'];
    $car_type = $_POST['car_type'];
    $accessories = implode(', ', $_POST['accessories'] ?? []);

    // Handle file uploads
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];
    $image4 = $_FILES['image4']['name'] ?? null;
    $image5 = $_FILES['image5']['name'] ?? null;

    // Move uploaded files to a directory
    $target_dir = '/uploads';
    move_uploaded_file($_FILES['image1']['tmp_name'], $upload_dir . $image1);
    move_uploaded_file($_FILES['image2']['tmp_name'], $upload_dir . $image2);
    move_uploaded_file($_FILES['image3']['tmp_name'], $upload_dir . $image3);
    if (!empty($image4))
        move_uploaded_file($_FILES['image4']['tmp_name'], $upload_dir . $image4);
    if (!empty($image5))
        move_uploaded_file($_FILES['image5']['tmp_name'], $upload_dir . $image5);

    // Insert data into database
    $sql = "INSERT INTO vehicles (vehicle_title, brand, overview, price_per_day, fuel_type, model_year, seating_capacity, car_type, image1, image2, image3, image4, image5, accessories)
            VALUES ('$vehicle_title', '$brand', '$overview', '$price_per_day', '$fuel_type', '$model_year', '$seating_capacity', '$car_type', '$image1', '$image2', '$image3', '$image4', '$image5', '$accessories')";

    if ($conn->query($sql) === TRUE) {
        echo "Vehicle posted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>