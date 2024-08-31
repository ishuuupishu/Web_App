<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BMI_PHP_APP";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT AppUserID, Password FROM AppUsers WHERE Username=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();
        if (password_verify($pass, $hashedPassword)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['userID'] = $id;
            header("Location: ../index.php");
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that username!";
    }
    $stmt->close();
}

$conn->close();
?>
