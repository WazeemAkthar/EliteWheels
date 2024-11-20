<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'car_rental_system'); // Adjust as needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch count of vehicles
$sql_vehicles = "SELECT COUNT(*) AS vehicle_count FROM vehicles";
$result_vehicles = $conn->query($sql_vehicles);
$vehicle_count = $result_vehicles->fetch_assoc()['vehicle_count'];

// Fetch count of users
$sql_users = "SELECT COUNT(*) AS user_count FROM users";
$result_users = $conn->query($sql_users);
$user_count = $result_users->fetch_assoc()['user_count'];

// Fetch count of rentals
$sql_rentals = "SELECT COUNT(*) AS rental_count FROM rentals";
$result_rentals = $conn->query($sql_rentals);
$rental_count = $result_rentals->fetch_assoc()['rental_count'];

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>

<style>
    .dashboard {
        width: 80%;
        margin: 0 auto;
        padding-top: 50px;
    }

    .dashboard-item {
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .dashboard-item h2 {
        font-size: 24px;
    }

    .dashboard-item p {
        font-size: 18px;
        font-weight: bold;
    }
</style>

<body>
    <div class="dashboard">
        <h1>Admin Dashboard</h1>

        <!-- Display vehicle count -->
        <div class="dashboard-item">
            <h2>Total Vehicles</h2>
            <p><?php echo $vehicle_count; ?></p>
        </div>

        <!-- Display user count -->
        <div class="dashboard-item">
            <h2>Total Users</h2>
            <p><?php echo $user_count; ?></p>
        </div>

        <!-- Display rental count -->
        <div class="dashboard-item">
            <h2>Total Rentals</h2>
            <p><?php echo $rental_count; ?></p>
        </div>

        <!-- Display booking count -->
        <div class="dashboard-item">
            <h2>Total Bookings</h2>
            <p><?php echo $booking_count; ?></p>
        </div>
    </div>
</body>

</html>