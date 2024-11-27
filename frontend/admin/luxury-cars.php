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
</head>

<body>
  <!-- Sidebar -->
  <?php include('./sidebar.php'); ?>
  <div class="container">



    <form action="../../Backend/upload_Luxury_car.php" method="POST" enctype="multipart/form-data">
      <label for="carName">Car Name:</label>
      <input type="text" name="car_name" required><br>

      <label for="location">Location/Address:</label>
      <input type="text" name="location" required><br>

      <label for="bodyType">Body Type:</label>
      <input type="text" name="body_type" required><br>

      <label for="fuelType">Fuel Type:</label>
      <input type="text" name="fuel_type" required><br>

      <label for="brand">Select Brand:</label>
      <select id="brand" name="brand" required>
        <option value="">Select</option>
        <?php while ($row = $result->fetch_assoc()): ?>
          <option value="<?php echo $row['brand_name']; ?>"><?php echo $row['brand_name']; ?></option>
        <?php endwhile; ?>
      </select>

      <label for="price">Price Per Day (in LKR):</label>
      <input type="number" step="0.01" name="price_per_day" required><br>

      <label for="modelYear">Model Year:</label>
      <input type="number" name="model_year" min="1900" max="2100" required><br>

      <label for="seatingCapacity">Seating Capacity:</label>
      <input type="number" name="seating_capacity" required><br>

      <label for="image1">Upload Image 1:</label>
      <input type="file" name="image1" accept="image/*" required><br>

      <label for="image2">Upload Image 2:</label>
      <input type="file" name="image2" accept="image/*" required><br>

      <label for="image3">Upload Image 3:</label>
      <input type="file" name="image3" accept="image/*" required><br>

      <label for="image4">Upload Image 4:</label>
      <input type="file" name="image4" accept="image/*" required><br>

      <h4>Accessories:</h4>
      <label><input type="checkbox" name="accessories[air_conditioner]"> Air Conditioner</label><br>
      <label><input type="checkbox" name="accessories[power_door_locks]"> Power Door Locks</label><br>
      <label><input type="checkbox" name="accessories[abs]"> Anti-Lock Braking System</label><br>
      <label><input type="checkbox" name="accessories[brake_assist]"> Brake Assist</label><br>
      <label><input type="checkbox" name="accessories[power_steering]"> Power Steering</label><br>
      <label><input type="checkbox" name="accessories[passenger_airbag]"> Passenger Airbag</label><br>
      <label><input type="checkbox" name="accessories[driver_airbag]"> Driver Airbag</label><br>
      <label><input type="checkbox" name="accessories[leather_seats]"> Leather Seats</label><br>

      <button type="submit">Upload Car</button>
    </form>

  </div>
</body>

</html>