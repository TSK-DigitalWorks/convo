<?php
$servername = "sql208.infinityfree.com";
$username = "if0_36607024";
$password = "karthik1310";
$dbname = "if0_36607024_convo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sender = $_POST['sender'];
$recipient = $_POST['recipient'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (sender, recipient, message) VALUES ('$sender', '$recipient', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
