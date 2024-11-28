<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "car_rental_system");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch luxury cars
$sql = "SELECT id, vehicle_title, brand, model_year, price_per_day, seating_capacity FROM vehicles WHERE car_type = 'Luxury'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luxury Cars</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f4f4f4;
    }

    .action-buttons button {
      margin-right: 5px;
      padding: 5px 10px;
      border: none;
      cursor: pointer;
    }

    .edit-btn {
      background-color: #4CAF50;
      color: white;
    }

    .delete-btn {
      background-color: #f44336;
      color: white;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <?php include('./sidebar.php'); ?>

  <div class="container">


    <h1>Luxury Cars</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Vehicle Title</th>
          <th>Brand</th>
          <th>Model Year</th>
          <th>Price Per Day</th>
          <th>Seating Capacity</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['vehicle_title']; ?></td>
              <td><?php echo $row['brand']; ?></td>
              <td><?php echo $row['model_year']; ?></td>
              <td><?php echo $row['price_per_day']; ?></td>
              <td><?php echo $row['seating_capacity']; ?></td>
              <td class="action-buttons">

                <button type="submit" class="edit-btn">Edit</button>


                <button type="submit" class="delete-btn"
                  onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</button>

              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="7">No luxury cars available.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>

<?php $conn->close(); ?>