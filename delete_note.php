<?php
$servername = "info.tm.edu.ro";
$username = "acrisan2"; // Change to your DB username
$password = "40671"; // Change to your DB password
$dbname = "school_notes"; // Change to your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the note ID from POST
$id = $_POST['id'];

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM notes WHERE id = ?");
$stmt->bind_param("i", $id);

// Execute
if ($stmt->execute()) {
    echo "Note deleted successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>