<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "acrisan2"; // Change to your DB username
$password = "40671"; // Change to your DB password
$dbname = "acrisan2"; // Change to your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get the note ID from POST
$id = $_POST['id'];

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM notes WHERE id = ?");
if (!$stmt) {
    echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
    exit;
}
$stmt->bind_param("i", $id);

// Execute
if ($stmt->execute()) {
    echo json_encode(['success' => 'Note deleted successfully']);
} else {
    echo json_encode(['error' => 'Execute failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
?>