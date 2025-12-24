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

$sql = "SELECT id, name, path FROM files ORDER BY uploaded_at DESC";
$result = $conn->query($sql);

if (!$result) {
    echo "error: Query failed: " . $conn->error;
    exit;
}

$files = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $files[] = $row;
    }
}

foreach ($files as $file) {
    echo "<div class='note'><a href='{$file['path']}' target='_blank'>Fișier: {$file['name']}</a>";
    if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file['name'])) {
        echo "<img src='{$file['path']}' style='max-width: 150px; display: block; margin-top: 5px;'>";
    }
    echo "<a href='{$file['path']}' download='{$file['name']}' style='display: block; margin-top: 5px;'>Descarcă</a></div>";
}

$conn->close();
?>