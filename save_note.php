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

// Get the note content from POST
$content = $_POST['content'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO notes (content) VALUES (?)");
if (!$stmt) {
    echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
    exit;
}
$stmt->bind_param("s", $content);

// Execute
if ($stmt->execute()) {
    echo json_encode(['success' => 'Note saved successfully']);
} else {
    echo json_encode(['error' => 'Execute failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
?>