<?php
// Replace with your actual SQLite database file path
$databaseFile = 'https://sqliteonline.com/#sharedb=m%3Alinnea';

// Create a new SQLite connection
try {
    $pdo = new PDO('sqlite:' . $databaseFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the SQLite database successfully<br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$sql = "INSERT INTO users (email_id, password, first_name, last_name, streaming_services)
        VALUES ('$email', '$password', '$first_name', '$last_name', '$streaming_services')";

if ($conn->query($sql) === TRUE) {
    echo "Sign up successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
