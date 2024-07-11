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

$user_id = $_SESSION["user_id"];

// Retrieve list of users (for the first registered user only)
$stmt = $conn->prepare("SELECT id, username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of the first registered user
    $user = $result->fetch_assoc();
    echo "User ID: " . $user["id"] . "<br>";
    echo "Username: " . $user["username"] . "<br>";
    echo "Email: " . $user["email"] . "<br>";
} else {
    echo "No users found.";
}

$stmt->close();
$conn->close();
?>
