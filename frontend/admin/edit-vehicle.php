<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'car_rental_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the vehicle details by ID (if editing)
$vehicle_id = $_GET['id'] ?? null;
if ($vehicle_id) {
    $sql = "SELECT * FROM vehicles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $vehicle = $result->fetch_assoc();
    $stmt->close();
} else {
    die("Invalid vehicle ID.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Sidebar -->
    <?php include('./sidebar.php'); ?>

    <div class="container">


        <form action="../../Backend/update_vehicle.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['id']; ?>">

            <label for="vehicle_title">Vehicle Title:</label>
            <input type="text" name="vehicle_title" id="vehicle_title"
                value="<?php echo $vehicle['vehicle_title']; ?>"><br>

            <label for="brand">Brand:</label>
            <input type="text" name="brand" id="brand" value="<?php echo $vehicle['brand']; ?>"><br>

            <label for="overview">Overview:</label>
            <textarea name="overview" id="overview"><?php echo $vehicle['overview']; ?></textarea><br>

            <label for="price_per_day">Price per Day:</label>
            <input type="number" name="price_per_day" id="price_per_day"
                value="<?php echo $vehicle['price_per_day']; ?>"><br>

            <label for="fuel_type">Fuel Type:</label>
            <input type="text" name="fuel_type" id="fuel_type" value="<?php echo $vehicle['fuel_type']; ?>"><br>

            <label for="model_year">Model Year:</label>
            <input type="number" name="model_year" id="model_year" value="<?php echo $vehicle['model_year']; ?>"><br>

            <label for="seating_capacity">Seating Capacity:</label>
            <input type="number" name="seating_capacity" id="seating_capacity"
                value="<?php echo $vehicle['seating_capacity']; ?>"><br>

            <label for="car_type">Car Type:</label>
            <input type="text" name="car_type" id="car_type" value="<?php echo $vehicle['car_type']; ?>"><br>

            <label for="street">Street:</label>
            <input type="text" name="street" id="street" value="<?php echo $vehicle['address']; ?>"><br>

            <label for="city">City:</label>
            <input type="text" name="city" id="city" value="<?php echo $vehicle['city']; ?>"><br>

            <label for="state">State:</label>
            <input type="text" name="state" id="state" value="<?php echo $vehicle['state']; ?>"><br>

            <label for="zip">Zip Code:</label>
            <input type="text" name="zip" id="zip" value="<?php echo $vehicle['zip']; ?>"><br>

            <!-- Handle image uploads similarly as in the add form -->
            <label for="image1">Image 1:</label>
            <input type="file" name="image1" id="image1"><br>

            <label for="image2">Image 2:</label>
            <input type="file" name="image2" id="image2"><br>

            <label for="image3">Image 3:</label>
            <input type="file" name="image3" id="image3"><br>

            <label for="image4">Image 4:</label>
            <input type="file" name="image4" id="image4"><br>

            <label for="image5">Image 5:</label>
            <input type="file" name="image5" id="image5"><br>

            <!-- Checkbox values for accessories -->
            <label>Air Conditioner:</label>
            <input type="checkbox" name="accessories[air_conditioner]" <?php echo $vehicle['air_conditioner'] ? 'checked' : ''; ?>><br>

            <label><input type="checkbox" name="accessories[power_door_locks]" value="Power Door Locks" /> Power Door
                Locks</label>
            <label><input type="checkbox" name="accessories[abs]" <?php echo $vehicle['abs'] ? 'checked' : ''; ?> />
                AntiLock Braking
                System</label>
            <label><input type="checkbox" name="accessories[brake_assist]" value="Brake Assist" /> Brake Assist</label>
            <label><input type="checkbox" name="accessories[power_steering]" value="Power Steering" /> Power
                Steering</label>
            <label><input type="checkbox" name="accessories[passenger_airbag]" value="Passenger Airbag" /> Passenger
                Airbag</label>
            <label><input type="checkbox" name="accessories[driver_airbag]" value="Driver Airbag" /> Driver
                Airbag</label>
            <label><input type="checkbox" name="accessories[leather_seats]" value="Leather Seats" /> Leather
                Seats</label>
            <!-- Repeat for other accessories... -->

            <button type="submit">Update Vehicle</button>
        </form>
    </div>
    <?php
    $conn->close();
    ?>

</body>

</html>