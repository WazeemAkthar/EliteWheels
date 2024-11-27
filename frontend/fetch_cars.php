<?php
require_once '../Backend/db.php';

$query = "SELECT * FROM luxury_cars";
$result = $conn->query($query);

$cars = [];
while ($row = $result->fetch_assoc()) {
    $cars[] = $row;
}

echo json_encode($cars);
?>