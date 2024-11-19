<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    header("Location: ../login.html");
    exit();
}

require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // First, delete related records from the orders table
    $sqlOrders = "DELETE FROM orders WHERE user_id = ?";
    $stmtOrders = $conn->prepare($sqlOrders);
    $stmtOrders->bind_param("i", $id);

    if ($stmtOrders->execute()) {
        // Now delete the user
        $sqlUser = "DELETE FROM users WHERE id = ?";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->bind_param("i", $id);

        if ($stmtUser->execute()) {
            header("Location: ./frontend/admin/ManageAccount.php");
        } else {
            echo "Error deleting user: " . $conn->error;
        }

        $stmtUser->close();
    } else {
        echo "Error deleting related orders: " . $conn->error;
    }

    $stmtOrders->close();
    $conn->close();
} else {
    echo "No ID provided";
}
?>