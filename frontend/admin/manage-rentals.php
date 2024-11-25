<?php
// Database connection
include '../../Backend/db.php';

// Fetch all rental records
$query = "SELECT * FROM rentals ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error fetching data: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Manage Rentals</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        button {
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
            border: none;
            color: #fff;
        }

        .confirm-btn {
            background-color: #28a745;
        }

        .cancel-btn {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include('./sidebar.php'); ?>

    <div class="container">
        <h1>Admin: Manage Rentals</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Vehicle Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                // Display fetched rental data
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $counter . "</td>";
                    echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vehicle_name']) . "</td>";
                    echo "<td>" . $row['rental_start'] . "</td>";
                    echo "<td>" . $row['rental_end'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                    echo "<td>
                    <button class='confirm-btn' onclick=\"updateRentalStatus(" . $row['id'] . ", 'confirmed')\">Confirm</button>
                    <button class='cancel-btn' onclick=\"updateRentalStatus(" . $row['id'] . ", 'cancelled')\">Cancel</button>
                </td>";
                    echo "</tr>";
                    $counter++; // Increment the counter for the next row
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function updateRentalStatus(rentalId, status) {
            if (confirm("Are you sure you want to " + status + " this rental?")) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "../../Backend/update-rental-status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        location.reload();
                    } else {
                        alert("Error updating status.");
                    }
                };
                xhr.send("id=" + rentalId + "&status=" + status);
            }
        }
    </script>
</body>

</html>