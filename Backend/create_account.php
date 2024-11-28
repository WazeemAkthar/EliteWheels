<?php
session_start();
require_once 'db.php';

// Check if the user is an admin
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    header("Location: ../Pages/login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Validate that passwords match
    if ($_POST['password'] != $_POST['confirm_password']) {
        die('Passwords do not match!');
    }

    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $password, $role);

    if ($stmt->execute()) {
        header("Location: ../frontend/admin/ManageAccount.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>