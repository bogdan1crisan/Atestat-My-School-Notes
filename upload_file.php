<?php
$servername = "localhost";
$username = "acrisan2";
$password = "40671";
$dbname = "acrisan2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "error: Connection failed: " . $conn->connect_error;
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['file'])) {
    echo "error: Invalid request";
    exit;
}

$file = $_FILES['file'];
$fileName = basename($file['name']);
$targetDir = 'uploads/';
$targetFile = $targetDir . uniqid() . '_' . $fileName;

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

if (move_uploaded_file($file['tmp_name'], $targetFile)) {
    $stmt = $conn->prepare("INSERT INTO files (name, path) VALUES (?, ?)");
    if (!$stmt) {
        echo "error: Prepare failed: " . $conn->error;
        exit;
    }
    $stmt->bind_param("ss", $fileName, $targetFile);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: Execute failed: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "error: Failed to move uploaded file";
}

$conn->close();
?>