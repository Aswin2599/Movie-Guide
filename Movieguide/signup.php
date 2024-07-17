<?php
include('config.php');

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password']; 

$services = $_POST['streaming_services']; // Assuming this is an array
$servicesString = implode(", ", $services);

$query = "INSERT INTO Users (FirstName, LastName, Email, Password, StreamingServices) VALUES (?, ?, ?, ?, ?)";
$params = array($firstName, $lastName, $email, $password, $servicesString);

$stmt = sqlsrv_query( $conn, $query, $params);

if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}
echo "Welcome";
?>
