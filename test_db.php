<?php
// Error reporting ON karein taake asli wajah pata chale
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('includes/db.php');

if ($conn) {
    echo "<h1>Mubarak ho! Database sahi se connect ho gaya hai.</h1>";
} else {
    echo "<h1>Database connect nahi ho saka!</h1>";
}
?>