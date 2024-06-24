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

$sender = $_GET['sender'];
$recipient = $_GET['recipient'];

// Prepare and bind
$stmt = $conn->prepare("SELECT sender, message FROM messages WHERE (sender=? AND recipient=?) OR (sender=? AND recipient=?) ORDER BY timestamp");
$stmt->bind_param("ssss", $sender, $recipient, $recipient, $sender);

// Execute the statement
$stmt->execute();

// Bind result variables
$stmt->bind_result($sender_result, $message_result);

// Fetch values
$messages = array();
while ($stmt->fetch()) {
    $messages[] = array("sender" => $sender_result, "message" => $message_result);
}

// Close statement and connection
$stmt->close();
$conn->close();

// Set response headers
header('Content-Type: application/json');
echo json_encode($messages);
?>
