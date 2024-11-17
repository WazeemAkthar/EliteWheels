// setup_admin.php
<?php
require 'db.php';

try {
    // Check if the default admin account exists
    $query = "SELECT COUNT(*) FROM admin WHERE username = 'admin'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $exists = $stmt->fetchColumn();

    if (!$exists) {
        // Insert default admin account with hashed password
        $adminUsername = 'admin';
        $adminPassword = password_hash('12345', PASSWORD_DEFAULT); // Replace 'password123' with a secure password
        $insertAdmin = "INSERT INTO admin (username, password) VALUES (:username, :password)";
        $stmt = $conn->prepare($insertAdmin);
        $stmt->execute(['username' => $adminUsername, 'password' => $adminPassword]);
        echo "Default admin account created successfully.";
    } else {
        echo "Admin account already exists.";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>