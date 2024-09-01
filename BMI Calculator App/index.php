<?php
header("Location: html/bmi_calculator.html");
exit;
?>


<?php
require_once 'php/create_database.php';
session_start();
include 'includes/header.php';
include 'includes/navbar.php';

if (!isset($_SESSION['loggedin'])) {
    echo "<p>Please <a href='html/login.html'>log in</a> to use the BMI Calculator.</p>";
} else {
    include 'html/bmi_calculator.html';
}

include 'includes/footer.php';
?>
