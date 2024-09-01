<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BMI_PHP_APP";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db($dbname);

// Create tables
$sql = "
CREATE TABLE IF NOT EXISTS AppUsers (
    AppUserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,  
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS BMIUsers (
    BMIUserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Age INT,
    Gender ENUM('Male', 'Female', 'Other'),
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS BMIRecords (
    RecordID INT AUTO_INCREMENT PRIMARY KEY,
    BMIUserID INT,
    Height FLOAT NOT NULL,
    Weight FLOAT NOT NULL,
    BMI FLOAT NOT NULL,
    RecordedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (BMIUserID) REFERENCES BMIUsers(BMIUserID)
);
";

if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created successfully<br>";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close();
?>
