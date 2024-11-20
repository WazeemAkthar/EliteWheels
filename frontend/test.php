<?php
session_start();
$conn = new mysqli("localhost", "root", "", "car_rental_system");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Get the vehicle ID from the query parameter
if (isset($_GET['vhid'])) {
    $vehicle_id = $_GET['vhid'];

    // Fetch vehicle details from the database
    $sql = "SELECT * FROM vehicles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();
    $vehicle = $stmt->get_result()->fetch_assoc();

    // If no vehicle found, redirect back
    if (!$vehicle) {
        echo "<script>alert('Vehicle not found!'); window.location.href = 'index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href = 'index.php';</script>";
    exit();
}

// Handle booking form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $message = $_POST['message'];

    $insert_sql = "INSERT INTO bookings (car_id, user_id, start_date, end_date, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("iisss", $vehicle_id, $user_id, $start_date, $end_date, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!');</script>";
    } else {
        echo "<script>alert('Booking failed! Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $vehicle['vehicle_title']; ?> Details</title>
    <style>
        /* Add your CSS styling here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .vehicle-details {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .vehicle-images img {
            max-width: 100%;
            height: auto;
            margin: 5px;
        }
        .vehicle-info {
            margin-top: 20px;
        }
        .booking-form {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="vehicle-details">
        <h1><?php echo $vehicle['vehicle_title']; ?></h1>
        <div class="vehicle-images">
            <img src="<?php echo $vehicle['image1']; ?>" alt="Image 1">
            <img src="<?php echo $vehicle['image2']; ?>" alt="Image 2">
            <img src="<?php echo $vehicle['image3']; ?>" alt="Image 3">
            <?php if ($vehicle['image4']) { ?>
                <img src="<?php echo $vehicle['image4']; ?>" alt="Image 4">
            <?php } ?>
            <?php if ($vehicle['image5']) { ?>
                <img src="<?php echo $vehicle['image5']; ?>" alt="Image 5">
            <?php } ?>
        </div>

        <div class="vehicle-info">
            <p><strong>Brand:</strong> <?php echo $vehicle['brand']; ?></p>
            <p><strong>Model Year:</strong> <?php echo $vehicle['model_year']; ?></p>
            <p><strong>Fuel Type:</strong> <?php echo $vehicle['fuel_type']; ?></p>
            <p><strong>Seating Capacity:</strong> <?php echo $vehicle['seating_capacity']; ?></p>
            <p><strong>Car Type:</strong> <?php echo $vehicle['car_type']; ?></p>
            <p><strong>Price Per Day:</strong> $<?php echo $vehicle['price_per_day']; ?></p>
            <h3>Overview</h3>
            <p><?php echo $vehicle['overview']; ?></p>

            <h3>Accessories</h3>
            <p><?php echo $vehicle['accessories']; ?></p>
        </div>

        <div class="booking-form">
            <h3>Book Now</h3>
            <form method="POST" action="">
                <label for="start_date">From Date:</label>
                <input type="date" name="start_date" id="start_date" required>

                <label for="end_date">To Date:</label>
                <input type="date" name="end_date" id="end_date" required>

                <label for="message">Message:</label>
                <textarea name="message" id="message" rows="4"></textarea>

                <button type="submit">Book Now</button>
            </form>
        </div>
    </div>
</body>
</html>
