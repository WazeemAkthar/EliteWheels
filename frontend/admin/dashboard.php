<?php
session_start();
if (!isset($_SESSION['role_id'])) {
  header("Location: ../login.html");
  exit();
}

// Define role IDs for staff and admin
$staffRoleId = 2; // Example: 2 = Staff
$adminRoleId = 3; // Example: 1 = Admin


$servername = "localhost";
$username = "root"; // or your database username
$password = ""; // or your database password
$dbname = "car_rental_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
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

$sql_brands = "SELECT COUNT(*) AS brand_count FROM brands";
$result_brands = $conn->query($sql_brands);
$brand_count = $result_brands->fetch_assoc()['brand_count'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/admin.css" />
  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <!-- Sidebar -->
  <?php include('./sidebar.php'); ?>

  <!-- Main Content -->
  <main class="main-content">
    <header class="content-header">
      <h1>Dashboard</h1>
    </header>
    <section class="cards">
      <div class="card blue">
        <h3><?php echo $user_count; ?></h3>
        <p>Reg Users</p>
        <!-- <a href="#">Full Detail &rarr;</a> -->
      </div>
      <div class="card green">
        <h3><?php echo $vehicle_count; ?></h3>
        <p>Listed Vehicles</p>
        <!-- <a href="#">Full Detail &rarr;</a> -->
      </div>
      <div class="card sky">
        <h3><?php echo $rental_count; ?></h3>
        <p>Total Bookings</p>
        <!-- <a href="#">Full Detail &rarr;</a> -->
      </div>
      <div class="card orange">
        <h3><?php echo $brand_count; ?></h3>
        <p>Listed Brands</p>
        <!-- <a href="#">Full Detail &rarr;</a> -->
      </div>
      <div class="card gold">
        <h3>1</h3>
        <p>Luxury Vehicles</p>
        <!-- <a href="#">Full Detail &rarr;</a> -->
      </div>
      <!-- Add more cards as needed -->
    </section>
  </main>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch('login.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            alert('Login successful');
            // Redirect based on role
            if (data.role === 'admin') {
              window.location.href = 'admin/dashboard.html';
            } else if (data.role === 'staff') {
              window.location.href = 'staff/staff-dashboard.html';
            } else if (data.role === 'customer') {
              window.location.href = 'homepage.html';
            }
          } else {
            alert('Login failed');
          }
        });
    });
  </script>

</body>

</html>