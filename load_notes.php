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

// Fetch notes
$sql = "SELECT id, content FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(['error' => 'Query failed: ' . $conn->error]);
    exit;
}

$notes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

echo json_encode($notes);

$conn->close();
?>