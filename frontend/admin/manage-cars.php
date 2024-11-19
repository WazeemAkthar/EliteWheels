<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include('./sidebar.php'); ?>

    <div class="container">
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

    <!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Edit Car</h2>
        <form method="POST" action="manage-cars.php">
            <input type="hidden" name="id" id="edit-id">
            <input type="text" name="name" id="edit-name" placeholder="Car Name" required>
            <input type="text" name="brand" id="edit-brand" placeholder="Brand" required>
            <input type="text" name="model" id="edit-model" placeholder="Model" required>
            <input type="number" name="year" id="edit-year" placeholder="Year" required>
            <input type="number" name="price" id="edit-price" placeholder="Price" step="0.01" required>
            <input type="text" name="location" id="edit-location" placeholder="Location" required>
            <label>
                <input type="checkbox" name="availability" id="edit-availability"> Available
            </label>
            <button type="submit" name="update_car">Update Car</button>
        </form>
    </div>
</div>


</body>
<script></script>

</html>