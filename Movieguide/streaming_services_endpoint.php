<?php
header('Content-Type: application/json');

// Starting the session
session_start();

// Your database connection details
$host = 'LAPTOP-NV52G4EE\SQLEXPRESS';
$db   = 'master';
$user = 'sa';
$pass = 'abewin3451';
$charset = 'utf8mb4';

// Setting up the database connection
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Fetching streaming services for the logged-in user
$userID = $_SESSION['userID'];
$stmt = $mysqli->prepare("SELECT StreamingServices FROM users WHERE user_id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$services = [];
while ($row = $result->fetch_assoc()) {
    $services[] = $row['streaming_service'];
}

$stmt->close();
$mysqli->close();

echo json_encode($services);
?>
