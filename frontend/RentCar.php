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
    <title>Document</title>
</head>

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
                <button type="submit">Filter</button>
            </form>
        </div>
    </section>
    <?php include('./cars.php'); ?>
    <?php include('./footer.php'); ?>
</body>

</html>