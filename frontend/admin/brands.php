<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    header("Location: ../login.php");
    exit();
}

// Database Connection
$conn = new mysqli("localhost", "root", "", "car_rental_system");

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Form Submission for Create and Update
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand_name = $_POST['brand_name'];
    $brand_id = isset($_POST['brand_id']) ? $_POST['brand_id'] : '';

    if (!empty($brand_id)) {
        // Update Brand
        $updateSql = "UPDATE brands SET brand_name = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("si", $brand_name, $brand_id);

        if ($stmt->execute()) {
            $message = "SUCCESS: Brand updated successfully.";
        } else {
            $message = "ERROR: Could not update the brand.";
        }
    } else {
        // Check if Brand Exists
        $checkSql = "SELECT * FROM brands WHERE brand_name = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $brand_name);
        $stmt->execute();
        $checkResult = $stmt->get_result();

        if ($checkResult->num_rows > 0) {
            $message = "This brand is already in the list.";
        } else {
            // Insert New Brand
            $insertSql = "INSERT INTO brands (brand_name) VALUES (?)";
            $stmt = $conn->prepare($insertSql);
            $stmt->bind_param("s", $brand_name);

            if ($stmt->execute()) {
                $message = "SUCCESS: Brand created successfully.";
            } else {
                $message = "ERROR: Could not create the brand.";
            }
        }
    }
}

// Handle Delete Request
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deleteSql = "DELETE FROM brands WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $message = "SUCCESS: Brand deleted successfully.";
    } else {
        $message = "ERROR: Could not delete the brand.";
    }
}

// Fetch Brands
$sql = "SELECT * FROM brands ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Brand</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .form-container {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            margin-bottom: 15px;
            font-size: 14px;
            color: #04cf5a;
            border: 1px solid;
            padding: 15px;
            border-radius: 6px;
            background-color: rgba(46, 204, 113, 0.2);
        }

        .message.error {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn.edit {
            background-color: #007bff;
            color: white;
        }

        .btn.delete {
            background-color: #e74c3c;
            color: white;
        }
        a{
            text-decoration: none;
        }
    </style>
    <script>
        function editBrand(id, name) {
            document.getElementById('brand_id').value = id;
            document.getElementById('brand_name').value = name;
        }
    </script>
</head>

<body>
    <!-- Sidebar -->
    <?php include('./sidebar.php'); ?>
    <div class="container">
        <div class="form-container">
            <h2>Create/Update Brand</h2>
            <?php if (!empty($message)): ?>
                <div class="message <?= strpos($message, 'SUCCESS') !== false ? '' : 'error'; ?>">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="hidden" id="brand_id" name="brand_id" value="">
                <label for="brand_name">Brand Name:</label>
                <input type="text" id="brand_name" name="brand_name" required
                    style="width: 100%; padding: 10px; margin-bottom: 15px;">
                <button type="submit"
                    style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
            </form>
        </div>

        <h3>Available Brands</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . htmlspecialchars($row['brand_name']) . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>
                            <button class='btn edit' onclick=\"editBrand(" . $row['id'] . ", '" . htmlspecialchars($row['brand_name']) . "')\">Edit</button>
                            <a href='?delete=" . $row['id'] . "' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this brand?');\">Delete</a>
                          </td>";
                        echo "</tr>";
                        $counter++; // Increment the counter for the next row
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align: center;'>No Brands Found</td></tr>";

                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>