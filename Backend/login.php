<?php
session_start();
require_once './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $stmt = $conn->prepare("SELECT users.id, users.name, users.password, users.role_id, roles.role_name 
                            FROM users 
                            JOIN roles ON users.role_id = roles.id 
                            WHERE users.email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashed_password, $role_id, $role_name);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Store user details in session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['role_id'] = $role_id;
            $_SESSION['role_name'] = $role_name;

            // Redirect based on the role
            if ($role_id == 3) { // Admin
                header("Location: ../frontend/admin/dashboard.php");
            } elseif ($role_id == 2) { // Staff
                header("Location: ../frontend/staff/staff-dashboard.html");
            } else {
                header("Location: ../frontend/index.php");
            }
            exit;
        } else {
            $_SESSION['error'] = "Invalid password.";
            header("Location: ../frontend/login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "No user found with that email.";
        header("Location: ../frontend/login.php");
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
