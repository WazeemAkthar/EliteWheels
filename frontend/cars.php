<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "car_rental_system");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Handle Filter Form Submission
$filterCategory = isset($_GET['category']) ? $_GET['category'] : 'all';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Base query
$query = "SELECT * FROM vehicles WHERE 1=1";

// Apply filters
if ($filterCategory !== 'all') {
  $query .= " AND car_type = '$filterCategory'";
}
if (!empty($searchQuery)) {
  $query .= " AND vehicle_title LIKE '%$searchQuery%'";
}

// Execute query
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EliteWheels - Car Listings</title>
  <link rel="stylesheet" href="./assets/css/cars.css">
</head>
<style>
  /* General Styles */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

  .container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Filter Section */
  .filter-section {
    text-align: center;
    padding: 2rem 0;
    background-color: #f4f6f9;
  }

  .filter-section h1 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
  }

  .filter-section p {
    color: #555;
    margin-bottom: 1.5rem;
  }

  .filter-section form {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
  }

  .filter-section select,
  .filter-section input {
    padding: 0.8rem;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  .filter-section button {
    padding: 0.8rem 1.5rem;
    font-size: 1rem;
    border: none;
    background-color: #ffcd3c;
    color: #0d0d63;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
  }

  .filter-section button:hover {
    background-color: #d4a514;
  }

  /* Cars Listing Section */
  .cars-listing {
    padding: 2rem 0;
    background-color: #fff;
  }

  .cars-listing .grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
  }

  .car-card {
    background-color: #f4f6f9;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    text-align: center;
    padding: 1rem;
  }

  .car-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
  }

  .car-card h3 {
    font-size: 1.2rem;
    margin: 0.5rem 0;
  }

  .car-card p {
    color: #555;
    font-size: 0.9rem;
    margin-bottom: 1rem;
  }

  .car-card button {
    padding: 0.8rem;
    font-size: 1rem;
    border: none;
    background-color: #ffcd3c;
    color: #0d0d63;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
  }

  .car-card:hover {
    transform: translateY(-5px);
  }

  .car-card button:hover {
    background-color: #d4a514;
  }
</style>

<body>

  <?php include('./navbar.php'); ?>

  <!-- Filter Section -->
  <section class="filter-section">
    <div class="container">
      <h1>Our Vehicles</h1>
      <p>Find the perfect car for your journey.</p>
      <form id="filterForm" method="GET">
        <select name="category" id="category">
          <option value="all" <?= $filterCategory == 'all' ? 'selected' : '' ?>>All Categories</option>
          <option value="Regular" <?= $filterCategory == 'Regular' ? 'selected' : '' ?>>Economy</option>
          <option value="Luxury" <?= $filterCategory == 'Luxury' ? 'selected' : '' ?>>Luxury</option>
        </select>
        <input type="text" name="search" placeholder="Search by name..." id="search"
          value="<?= htmlspecialchars($searchQuery) ?>">
        <button type="submit" >Filter</button>
      </form>
    </div>
  </section>

  <!-- Cars Listing Section -->
  <section class="cars-listing">
    <div class="container">
      <div class="grid">
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($vehicle = mysqli_fetch_assoc($result)): ?>
            <div class="car-card">
              <img src="<?= htmlspecialchars($vehicle['image1']) ?>"
                alt="<?= htmlspecialchars($vehicle['vehicle_title']) ?>">
              <h3><?= htmlspecialchars($vehicle['vehicle_title']) ?></h3>
              <p>Seats: <?= $vehicle['seating_capacity'] ?> | Transmission: <?= $vehicle['fuel_type'] ?> | Price:
                $<?= $vehicle['price_per_day'] ?>/day</p>
              <button  onclick="navigateTotest()">View Details</button>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No vehicles found matching your criteria.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php include('./footer.php'); ?>
  <script>
     function navigateTotest() {
      // Replace 'your-page.html' with the desired URL or page path
      window.location.href = './test.php';
    }
  </script>

</body>

</html>