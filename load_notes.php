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

$sql = "SELECT id, content FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    echo "error: Query failed: " . $conn->error;
    exit;
}

$notes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

foreach ($notes as $note) {
    echo "<div class='note' data-id='{$note['id']}'><p>{$note['content']}</p><button onclick='deleteNote({$note['id']}, this.parentElement)'>Delete</button></div>";
}

$conn->close();
?>