<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<style>
    /* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #f5f6fa;
    color: #333;
    line-height: 1.6;
}

/* Profile container */
.profile-container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    text-align: center;
    color: #2c3e50;
}

.profile-info {
    text-align: center;
    margin: 20px 0;
}

.profile-info p {
    margin: 10px 0;
    font-size: 1.1em;
}

.profile-info span {
    font-weight: bold;
    color: #3498db;
}

/* Rented Vehicles Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

thead {
    background: #2c3e50;
    color: #fff;
}

thead th {
    padding: 10px;
    text-align: left;
}

tbody tr {
    border-bottom: 1px solid #ddd;
}

tbody td {
    padding: 10px;
}

tbody tr:nth-child(even) {
    background: #f9f9f9;
}

button {
    padding: 8px 15px;
    background: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.9em;
}

button:hover {
    background: #c0392b;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-container {
        padding: 15px;
    }

    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    thead th {
        font-size: 0.9em;
        padding: 8px;
    }

    tbody td {
        font-size: 0.9em;
        padding: 8px;
    }

    button {
        font-size: 0.8em;
    }
}

@media (max-width: 480px) {
    h1, h2 {
        font-size: 1.4em;
    }

    .profile-info p {
        font-size: 1em;
    }

    table {
        font-size: 0.8em;
    }

    button {
        font-size: 0.75em;
        padding: 5px 10px;
    }
}

</style>
<body>

    <?php include('./navbar.php'); ?>
    <div class="profile-container">
        <h1>User Profile</h1>
        <div class="profile-info">
            <p>Name: <span id="user-name"></span></p>
            <p>Email: <span id="user-email"></span></p>
        </div>

        <h2>Rented Vehicles</h2>
        <table id="rented-vehicles">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Brand</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Days Left</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        fetch('../Backend/get_profile.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('user-name').textContent = data.user.name;
                document.getElementById('user-email').textContent = data.user.email;

                const rentalsTable = document.querySelector('#rented-vehicles tbody');
                data.rentals.forEach(rental => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${rental.vehicle_title}</td>
                        <td>${rental.brand}</td>
                        <td>${rental.rental_start}</td>
                        <td>${rental.rental_end}</td>
                        <td>${rental.status}</td>
                        <td>${rental.days_left}</td>
                        <td>
                            <button onclick="cancelRental(${rental.rental_id})">Cancel</button>
                        </td>
                    `;
                    rentalsTable.appendChild(row);
                });
            });

        function cancelRental(rentalId) {
            fetch('../Backend/cancel_rental.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `rental_id=${rentalId}`
            })
                .then(response => response.json())
                .then(data => alert(data.success || data.error));
        }
    </script>
</body>

</html>