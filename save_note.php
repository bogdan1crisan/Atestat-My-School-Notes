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

// Get the note content from POST
$content = $_POST['content'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO notes (content) VALUES (?)");
$stmt->bind_param("s", $content);

// Execute
if ($stmt->execute()) {
    echo "Note saved successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>