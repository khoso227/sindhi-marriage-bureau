<?php
session_start();
session_unset();
session_destroy();

// Cookies khatam karna
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Seedha Home page par bhejien
header("Location: index.php");
exit();
?>