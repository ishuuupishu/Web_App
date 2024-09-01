<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../html/login.html");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BMI_PHP_APP";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bmi = $weight / ($height * $height);

    // Insert user info into BMIUsers table
    $stmt = $conn->prepare("INSERT INTO BMIUsers (Name, Age, Gender) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $age, $gender);
    $stmt->execute();
    $bmiUserID = $stmt->insert_id;

    // Insert BMI record into BMIRecords table
    $stmt = $conn->prepare("INSERT INTO BMIRecords (BMIUserID, Height, Weight, BMI) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iddd", $bmiUserID, $height, $weight, $bmi); // Use 'iddd' here

    if ($stmt->execute()) {
        echo "BMI calculated successfully! Your BMI is: " . $bmi;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
