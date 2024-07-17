<?php
include('config.php'); // Ensure your config.php returns the $pdo object.

// Check if form data is received
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // If user exists and the passwords match
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        echo "successfully Logged in";
        // Optionally, redirect to dashboard or any other page
        // header('Location: dashboard.php');
        exit;
    } else {
        echo "Invalid email or password!";
    }
}
?>
