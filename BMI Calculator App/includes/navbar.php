<?php
echo '<nav>
    <a href="index.php">Home</a>';
if (isset($_SESSION['loggedin'])) {
    echo '<a href="php/logout.php">Logout</a>';
} else {
    echo '<a href="html/login.html">Login</a>';
}
echo '</nav>';
?>
