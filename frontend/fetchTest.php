<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Cars Management</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .table-container {
            width: 90%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .alert {
            margin: 0 auto 15px;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            width: 90%;
            display: none;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            width: 50%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            position: relative;
        }

        .modal-content .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="alertMessage" class="alert"></div>

    <div class="table-container">
        <button class="btn" id="postLuxuryVehicleBtn">+ Post a Luxury Vehicle</button>
        <table>
            <thead>
                <tr>
                    <th>Car Name</th>
                    <th>Location</th>
                    <th>Body Type</th>
                    <th>Fuel Type</th>
                    <th>Brand</th>
                    <th>Price Per Day</th>
                    <th>Model Year</th>
                    <th>Seating Capacity</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="carsTableBody">
                <!-- Table rows will be added dynamically -->
            </tbody>
        </table>
    </div>

    <!-- Modal Form -->
    <div class="modal" id="luxuryVehicleModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <form id="luxuryVehicleForm">
                <input type="hidden" name="car_id" id="carId">
                <label>Car Name: <input type="text" name="car_name" id="carName" required></label><br>
                <!-- Add other form fields as needed -->
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        const alertMessage = document.getElementById('alertMessage');
        const modal = document.getElementById('luxuryVehicleModal');
        const postBtn = document.getElementById('postLuxuryVehicleBtn');
        const closeModal = document.getElementById('closeModal');

        // Show modal
        postBtn.addEventListener('click', () => {
            resetForm();
            modal.style.display = 'flex';
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        const resetForm = () => {
            document.getElementById('luxuryVehicleForm').reset();
            document.getElementById('carId').value = '';
        };

        const showAlert = (message, type) => {
            alertMessage.textContent = message;
            alertMessage.className = `alert ${type}`;
            alertMessage.style.display = 'block';
            setTimeout(() => {
                alertMessage.style.display = 'none';
            }, 3000);
        };

        // Fetch and display data dynamically
        const loadCars = async () => {
            const response = await fetch('fetch_cars.php');
            const cars = await response.json();

            const tableBody = document.getElementById('carsTableBody');
            tableBody.innerHTML = '';

            cars.forEach((car) => {
                const row = `
                    <tr>
                        <td>${car.car_name}</td>
                        <td>${car.location}</td>
                        <td>${car.body_type}</td>
                        <td>${car.fuel_type}</td>
                        <td>${car.brand}</td>
                        <td>${car.price_per_day}</td>
                        <td>${car.model_year}</td>
                        <td>${car.seating_capacity}</td>
                        <td>
                            <img src="${car.image1}" width="50">
                            <img src="${car.image2}" width="50">
                            <img src="${car.image3}" width="50">
                            <img src="${car.image4}" width="50">
                        </td>
                        <td>
                            <button class="btn" onclick="editCar(${car.id})">Edit</button>
                            <button class="btn" onclick="deleteCar(${car.id})">Delete</button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        };

        const editCar = async (id) => {
            const response = await fetch(`get_car.php?id=${id}`);
            const car = await response.json();

            document.getElementById('carId').value = car.id;
            document.getElementById('carName').value = car.car_name;
            // Populate other fields...

            modal.style.display = 'flex';
        };

        const deleteCar = async (id) => {
            const response = await fetch(`delete_car.php?id=${id}`, { method: 'DELETE' });
            const result = await response.json();

            if (result.success) {
                showAlert('Car deleted successfully!', 'success');
                loadCars();
            } else {
                showAlert('Failed to delete the car.', 'error');
            }
        };

        loadCars();
    </script>
</body>
</html>
