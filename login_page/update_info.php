<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process update info form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password for security

    // Prepare SQL statement to update password
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $new_password, $user_id);

    if ($stmt->execute()) {
        // Password updated successfully
        echo "Password updated successfully.";
    } else {
        // Update failed
        echo "Error updating password: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
