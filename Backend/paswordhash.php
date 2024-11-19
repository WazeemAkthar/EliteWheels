<?php
$hashedPassword = password_hash('1234', PASSWORD_BCRYPT);

// Connect to the database
require_once './db.php';

// Insert primary admin
$sql = "INSERT INTO users (name, email, password, role_id) VALUES ('Sahee', 'siyam@gmail.com', ?, 3)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hashedPassword);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Primary admin inserted successfully.";
} else {
    echo "Error inserting primary admin: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>