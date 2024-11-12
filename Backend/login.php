<?php
// Database connection (replace with your connection details)
$conn = new mysqli("localhost", "username", "password", "database");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT role FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();

    // Check if role exists and send appropriate response
    if ($role) {
        echo json_encode(['status' => 'success', 'role' => $role]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
    }
}
?>
