<?php
header('Content-Type: application/json');
$servername = "localhost:3306";
$username = "acrisan2";
$password = "40671";
$dbname = "acrisan2";

if (!class_exists('mysqli')) {
    echo json_encode(['error' => 'mysqli extension not loaded']);
    exit;
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
} else {
    echo json_encode(['success' => 'Connected successfully']);
}

$conn->close();
?>