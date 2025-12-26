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

$id = $_POST['id'];

// Get file path before deleting from database
$sql = "SELECT path FROM files WHERE id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "error: Prepare failed: " . $conn->error;
    exit;
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $filePath = $row['path'];
    
    // Delete from database
    $deleteStmt = $conn->prepare("DELETE FROM files WHERE id = ?");
    if (!$deleteStmt) {
        echo "error: Prepare failed: " . $conn->error;
        exit;
    }
    $deleteStmt->bind_param("i", $id);
    
    if ($deleteStmt->execute()) {
        // Delete file from filesystem
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        echo "success";
    } else {
        echo "error: Execute failed: " . $deleteStmt->error;
    }
    $deleteStmt->close();
} else {
    echo "error: File not found";
}

$stmt->close();
$conn->close();
?>
