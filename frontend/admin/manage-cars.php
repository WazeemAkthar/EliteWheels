<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "car_rental_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle Add/Edit Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicleId = $_POST['vehicleId'] ?? null;
    $vehicleTitle = $_POST['vehicleTitle'];
    $brand = $_POST['brand'];
    $overview = $_POST['overview'];
    $pricePerDay = $_POST['pricePerDay'];
    $fuelType = $_POST['fuelType'];
    $modelYear = $_POST['modelYear'];
    $seatingCapacity = $_POST['seatingCapacity'];
    $carType = $_POST['carType'];

    if ($vehicleId) {
        // Update vehicle
        $query = "UPDATE vehicles SET 
                    vehicle_title = '$vehicleTitle', 
                    brand = '$brand', 
                    overview = '$overview', 
                    price_per_day = '$pricePerDay', 
                    fuel_type = '$fuelType', 
                    model_year = $modelYear, 
                    seating_capacity = $seatingCapacity, 
                    car_type = '$carType' 
                  WHERE id = $vehicleId";
        mysqli_query($conn, $query);
    } else {
        // Add new vehicle
        $query = "INSERT INTO vehicles (vehicle_title, brand, overview, price_per_day, fuel_type, model_year, seating_capacity, car_type) 
                  VALUES ('$vehicleTitle', '$brand', '$overview', '$pricePerDay', '$fuelType', $modelYear, $seatingCapacity, '$carType')";
        mysqli_query($conn, $query);
    }
}

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM vehicles WHERE id = $id";
    mysqli_query($conn, $query);
}

// Fetch All Vehicles
$vehiclesQuery = "SELECT * FROM vehicles";
$vehiclesResult = mysqli_query($conn, $vehiclesQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vehicles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .add-btn {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #ffc107;
            color: black;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            height: 750px;
            overflow: scroll;
            scrollbar-width: none;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include('./sidebar.php'); ?>
    <div class="container">
        <h1>Vehicle Management</h1>
        <button id="addVehicleBtn" class="add-btn">+ Add Vehicle</button>

        <!-- Modal for Add/Edit Vehicle -->
        <div id="vehicleModal" class="modal">
            <div class="modal-content">
                <span id="closeModal" class="close-btn">&times;</span>
                <form id="vehicleForm" method="POST">
                    <input type="hidden" id="vehicleId" name="vehicleId">
                    <h2 id="formTitle">Add Vehicle</h2>
                    <label for="vehicleTitle">Vehicle Title</label>
                    <input type="text" id="vehicleTitle" name="vehicleTitle" required>
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" required>
                    <label for="overview">Overview</label>
                    <textarea id="overview" name="overview" required></textarea>
                    <label for="pricePerDay">Price Per Day</label>
                    <input type="number" id="pricePerDay" name="pricePerDay" required>
                    <label for="fuelType">Fuel Type</label>
                    <input type="text" id="fuelType" name="fuelType" required>
                    <label for="modelYear">Model Year</label>
                    <input type="number" id="modelYear" name="modelYear" required>
                    <label for="seatingCapacity">Seating Capacity</label>
                    <input type="number" id="seatingCapacity" name="seatingCapacity" required>
                    <label for="carType">Car Type</label>
                    <select id="carType" name="carType" required>
                        <option value="Regular">Regular</option>
                        <option value="Luxury">Luxury</option>
                    </select>

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
                    <button type="submit" class="submit-btn">Save</button>
                </form>
            </div>
        </div>

        <!-- Vehicles Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vehicle Title</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Fuel Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($vehicle = mysqli_fetch_assoc($vehiclesResult)) { ?>
                    <tr>
                        <td><?= $vehicle['id'] ?></td>
                        <td><?= $vehicle['vehicle_title'] ?></td>
                        <td><?= $vehicle['brand'] ?></td>
                        <td><?= $vehicle['price_per_day'] ?></td>
                        <td><?= $vehicle['fuel_type'] ?></td>
                        <td>
                            <button class="action-btn edit-btn"
                                onclick="editVehicle(<?= $vehicle['id'] ?>, '<?= $vehicle['vehicle_title'] ?>', '<?= $vehicle['brand'] ?>')">Edit</button>
                            <a style="text-decoration: none;" href="?delete=<?= $vehicle['id'] ?>"
                                class="action-btn delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        const modal = document.getElementById('vehicleModal');
        const addVehicleBtn = document.getElementById('addVehicleBtn');
        const closeModal = document.getElementById('closeModal');
        const vehicleForm = document.getElementById('vehicleForm');
        const formTitle = document.getElementById('formTitle');
        const vehicleIdInput = document.getElementById('vehicleId');

        addVehicleBtn.addEventListener('click', () => {
            formTitle.textContent = 'Add Vehicle';
            vehicleForm.reset();
            vehicleIdInput.value = '';
            modal.style.display = 'flex';
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        function editVehicle(id, title, brand) {
            formTitle.textContent = 'Edit Vehicle';
            vehicleIdInput.value = id;
            document.getElementById('vehicleTitle').value = title;
            document.getElementById('brand').value = brand;
            modal.style.display = 'flex';
        }
    </script>
</body>

</html>