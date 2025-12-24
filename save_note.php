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

$content = $_POST['content'];

$stmt = $conn->prepare("INSERT INTO notes (content) VALUES (?)");
if (!$stmt) {
    echo "error: Prepare failed: " . $conn->error;
    exit;
}
$stmt->bind_param("s", $content);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: Execute failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
?>