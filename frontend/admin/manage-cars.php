<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="Logo" class="logo-img" />
                <h1>EliteWheels</h1>
            </div>
            <nav class="menu">
                <button class="accordion">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </button>
                <button class="accordion">
                    <i class="fas fa-car"></i> Manage Cars
                </button>
                <div class="panel">
                    <a href="manage-cars.php">All Cars</a>
                    <a href="luxury-cars.html">Luxury Cars</a>
                </div>
                <button class="accordion">
                    <i class="fas fa-calendar-check"></i> Manage Rentals
                </button>
                <div class="panel">
                    <a href="manage-rentals.html">All Rentals</a>
                </div>
                <button class="accordion">
                    <i class="fas fa-users"></i> Manage Users
                </button>
                <div class="panel">
                    <a href="manage-users.html">All Users</a>
                </div>
                <button class="accordion">
                    <i class="fas fa-chart-line"></i> Reports
                </button>
                <div class="panel">
                    <a href="reports.html">View Reports</a>
                </div>

                <!-- Gold Gradient Button with Sub-Buttons -->
                <button class="accordion gold-button">
                    <i class="fas fa-star"></i> Premium Features
                </button>
                <div class="panel">
                    <a href="#">Sub Feature 1</a>
                    <a href="#">Sub Feature 2</a>
                </div>
            </nav>
        </aside>


        <main>
            <h1>Manage Cars</h1>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($car['id']); ?></td>
                            <td><?php echo htmlspecialchars($car['name']); ?></td>
                            <td><?php echo htmlspecialchars($car['brand']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['year']); ?></td>
                            <td>$<?php echo htmlspecialchars($car['price']); ?></td>
                            <td><?php echo htmlspecialchars($car['location']); ?></td>
                            <td><?php echo $car['availability'] ? 'Available' : 'Unavailable'; ?></td>
                            <td>
                                <a href="?delete=<?php echo $car['id']; ?>" class="delete-btn">Delete</a>
                                <!-- Add an edit button here -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Add New Car</h2>
            <form method="POST" action="manage-cars.php">
                <input type="text" name="name" placeholder="Car Name" required>
                <input type="text" name="brand" placeholder="Brand" required>
                <input type="text" name="model" placeholder="Model" required>
                <input type="number" name="year" placeholder="Year" required>
                <input type="number" name="price" placeholder="Price" step="0.01" required>
                <input type="text" name="location" placeholder="Location" required>
                <label>
                    <input type="checkbox" name="availability" checked> Available
                </label>
                <button type="submit" name="add_car">Add Car</button>
            </form>
        </main>
    </div>

</body>

</html>