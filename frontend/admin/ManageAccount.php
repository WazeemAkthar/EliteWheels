<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    header("Location: ../login.html");
    exit();
}

require_once '../../Backend/db.php';

// Fetch users where role is Staff (2) or Admin (3)
$sql_users = "SELECT id, name, email, role_id FROM users WHERE role_id IN (2, 3)";
$result_users = $conn->query($sql_users);
$users = [];
while ($row = $result_users->fetch_assoc()) {
    $users[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./frontend/assets/css/admin.css">
    <title>Admin Dashboard - The Gallery Café</title>
</head>
<style>
    .Dashbord-Container {
        display: none;
    }

    .dashboard-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin: 20px;
    }

    .form-container {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: max-content;
        padding: 20px;
        text-align: left;
        z-index: 1001;
    }

    .form-container.active {
        display: block;
    }

    .form-group {
        margin-bottom: 15px;
        width: 385px;
    }

    label {
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    input[type="time"] {
        width: calc(100% - 20px);
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .button-contaiiner {
        display: flex;
        gap: 5;
        justify-content: flex-end;
    }

    button[type="submit"] {
        display: block;
        padding: 10px;
        background-color: #5bc0de;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: max-content;
    }

    button[type="submit"]:hover {
        background-color: #31b0d5;
    }

    .table-card {
        display: flex;
        align-items: flex-start;
        justify-content: space-around;
        gap: 70px;
        margin-bottom: 40px;
    }

    .button-edit {
        background-color: #58d8ff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2px;
        width: 111px;
    }

    .button-edit:hover {
        background-color: #31b0d5;
    }

    .button-delete {
        background-color: #c9302c;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2px;
    }

    .button-delete:hover {
        background-color: #d9534f;
    }

    .title1 {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        z-index: 1000;
    }

    .form-overlay.active {
        display: block;
    }
</style>

<body>
    <!-- Sidebar -->
    <?php include('./sidebar.php'); ?>

    <div class="container">
        <div class="dashboard-container">
            <div id="form1" class="form-container">
                <h2>Create a New Account</h2>
                <form action="../Backend/create_account.php" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select id="role" name="role">
                            <option value="2">Staff</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>
                    <div class="button-contaiiner">
                        <button type="submit">Create Account</button>
                        <button type="cancel" onclick="showForm(null)">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="table-card">
                <div class="table-container Foods-And-Drinks">

                    <div class="title1">
                        <h2>Staffs and Admins Accounts</h2>
                        <button class="button-add" onclick="showForm('form1')">
                            <i class="material-icons">add</i>
                            Create Staff and Admin Accounts
                        </button>

                    </div>
                    <table class="w3-table w3-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo $user['role_id'] == 2 ? 'Staff' : 'Admin'; ?></td>
                                    <td>
                                        <button class="button-edit" onclick="editUser(<?php echo $user['id']; ?>)"><i
                                                class='material-icons'>edit</i>Edit</button>
                                        <button class="button-delete" onclick="deleteUser(<?php echo $user['id']; ?>)"><i
                                                class='material-icons'>delete</i>Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="formOverlay" class="form-overlay"></div>

    <script src="../JS/components.js"></script>
    <script src="../JS/scripts.js"></script>
    <script>
        function showForm(formId) {
            document.getElementById('form1').classList.remove('active');
            document.getElementById('formOverlay').classList.remove('active');
            if (formId) {
                document.getElementById(formId).classList.add('active');
                document.getElementById('formOverlay').classList.add('active');
            }
        }

        showForm(null);

        document.getElementById('formOverlay').addEventListener('click', function () {
            showForm(null);
        });

        function editUser(id) {
            // Redirect to an edit page with the user ID
            window.location.href = '../Backend/edit_user.php?id=' + id;
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                // Send a request to delete the user
                window.location.href = '../Backend/delete_user.php?id=' + id;
            }
        }
    </script>
    <script>
        function navigateToPage() {
            window.location.href = "Home.php";
        }
        function logout() {
            window.location.href = "../Backend/logout.php";
        }
    </script>
</body>

</html>