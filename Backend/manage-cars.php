<?php
// Database connection
$host = 'localhost';
$dbname = 'car_rental_system';
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Fetch cars from the database
$cars = $conn->query("SELECT * FROM cars")->fetchAll(PDO::FETCH_ASSOC);

// Add new car
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_car'])) {
    $stmt = $conn->prepare("INSERT INTO cars (name, brand, model, year, price, location, availability) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['brand'],
        $_POST['model'],
        $_POST['year'],
        $_POST['price'],
        $_POST['location'],
        isset($_POST['availability'])
    ]);
    header('Location: manage-cars.php');
}

// Delete car
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: manage-cars.php');
}

// Additional code for update functionality could be added here
?>