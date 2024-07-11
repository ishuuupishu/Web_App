<?php
session_start();

// Static credentials (in a real application, use a database)
$valid_username = "user";
$valid_password = "password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $valid_username && $password === $valid_password) {
        // Authentication successful, start session
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        // Authentication failed
        echo "<p>Login failed. Please try again.</p>";
    }
}
?>
