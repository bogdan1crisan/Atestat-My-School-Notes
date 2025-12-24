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

$stmt = $conn->prepare("DELETE FROM notes WHERE id = ?");
if (!$stmt) {
    echo "error: Prepare failed: " . $conn->error;
    exit;
}
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: Execute failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
?>