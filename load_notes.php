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

// Fetch notes
$sql = "SELECT id, content FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);

$notes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

echo json_encode($notes);

$conn->close();
?>