<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    header("Location: ../login.php");
    exit();
}

// Fetch brands from the database
$conn = new mysqli('localhost', 'root', '', 'car_rental_system'); // Adjust credentials
$result = $conn->query("SELECT id, brand_name FROM brands");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/admin.css" />
</head>
<style>
    /* General Form Styling */
    form {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    /* Section Titles */
    form h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
    }

    /* Labels */
    form label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        color: #34495e;
        font-weight: bold;
    }

    /* Input Fields */
    form input[type="text"],
    form input[type="number"],
    form textarea,
    form select {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        box-sizing: border-box;
        transition: 0.3s ease;
    }

    /* Focus Effect */
    form input:focus,
    form textarea:focus,
    form select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* File Input */
    form input[type="file"] {
        padding: 5px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    /* Checkboxes */
    form .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    form .checkbox-group label {
        font-size: 14px;
        color: #555;
    }

    /* Buttons */
    form button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    form button:hover {
        background-color: #0056b3;
    }

    /* Cancel Button */
    form .btn-cancel {
        background-color: #e74c3c;
        margin-right: 10px;
    }

    form .btn-cancel:hover {
        background-color: #c0392b;
    }

    /* Accessories Section */
    form .accessories {
        margin-top: 20px;
        padding: 10px;
        background-color: #ecf0f1;
        border-radius: 5px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        form {
            padding: 15px;
        }

        form .checkbox-group {
            flex-direction: column;
        }
    }

    .message-container {
        margin-bottom: 20px;
    }

    .alert {
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #dff0d8;
        color: #3c763d;
        border: 1px solid #d6e9c6;
    }

    .alert-danger {
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #ebccd1;
    }
</style>

<body>
    <!-- Sidebar -->
    <?php include('./sidebar.php'); ?>
    <div class="container">
        <div class="message-container">
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success">
                    <strong>SUCCESS:</strong> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger">
                    <strong>ERROR:</strong> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Reset messages after displaying -->
        <?php
        unset($_SESSION['success_message']);
        unset($_SESSION['error_message']);
        ?>

        <h1>Post A Vehicle</h1>
        <form action="../../Backend/post_vehicle.php" method="POST" enctype="multipart/form-data">
            <div class="basic-info">
                <h3>Basic Info</h3>
                <label for="vehicle_title">Vehicle Title *</label>
                <input type="text" id="vehicle_title" name="vehicle_title" required />

                <label for="brand">Select Brand *</label>
                <select id="brand" name="brand" required>
                    <option value="">Select</option>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?php echo $row['brand_name']; ?>"><?php echo $row['brand_name']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="overview">Vehicle Overview *</label>
                <textarea id="overview" name="overview" required></textarea>

                <label for="price_per_day">Price Per Day (in LKR) *</label>
                <input type="number" id="price_per_day" name="price_per_day" required />

                <label for="fuel_type">Select Fuel Type *</label>
                <select id="fuel_type" name="fuel_type" required>
                    <option value="">Select</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Electric">Electric</option>
                </select>

                <label for="model_year">Model Year *</label>
                <input type="number" id="model_year" name="model_year" required />

                <label for="seating_capacity">Seating Capacity *</label>
                <input type="number" id="seating_capacity" name="seating_capacity" required />

                <label for="car_type">Car Type *</label>
                <select id="car_type" name="car_type" required>
                    <option value="Regular">Regular</option>
                    <option value="Luxury">Luxury</option>
                </select>
            </div>

            <h3>Car Location</h3>
            <div class="address-section">
                <label for="street">Street Address *</label>
                <input type="text" id="street" name="street" required />

                <label for="city">City *</label>
                <input type="text" id="city" name="city" required />

                <label for="state">State *</label>
                <input type="text" id="state" name="state" required />

                <label for="zip">ZIP Code *</label>
                <input type="text" id="zip" name="zip" required />
            </div>

            <h3>Upload Images</h3>
            <div class="upload-images">
                <label for="image1">Image 1 *</label>
                <input type="file" id="image1" name="image1" required />

                <label for="image2">Image 2 *</label>
                <input type="file" id="image2" name="image2" required />

                <label for="image3">Image 3 *</label>
                <input type="file" id="image3" name="image3" required />

                <label for="image4">Image 4</label>
                <input type="file" id="image4" name="image4" />

                <label for="image5">Image 5</label>
                <input type="file" id="image5" name="image5" />
            </div>

            <h3>Accessories</h3>
            <div class="checkbox-group">
                <label><input type="checkbox" name="accessories[air_conditioner]" value="Air Conditioner" /> Air Conditioner</label>
                <label><input type="checkbox" name="accessories[power_door_locks]" value="Power Door Locks" /> Power Door Locks</label>
                <label><input type="checkbox" name="accessories[abs]" value="AntiLock Braking System" /> AntiLock Braking
                    System</label>
                <label><input type="checkbox" name="accessories[brake_assist]" value="Brake Assist" /> Brake Assist</label>
                <label><input type="checkbox" name="accessories[power_steering]" value="Power Steering" /> Power Steering</label>
                <label><input type="checkbox" name="accessories[passenger_airbag]" value="Passenger Airbag" /> Passenger Airbag</label>
                <label><input type="checkbox" name="accessories[driver_airbag]" value="Driver Airbag" /> Driver Airbag</label>
                <label><input type="checkbox" name="accessories[leather_seats]" value="Leather Seats" /> Leather Seats</label>
            </div>

            <button type="submit" class="save-btn">Save Changes</button>
            <button type="reset" class="cancel-btn">Cancel</button>
        </form>

    </div>
</body>

</html>