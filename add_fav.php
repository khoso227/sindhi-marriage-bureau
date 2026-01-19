<?php
include('includes/db.php');
session_start();
$my_id = $_SESSION['user_id'];
$fav_id = $_GET['id'];
mysqli_query($conn, "INSERT INTO favorites (user_id, fav_id) VALUES ('$my_id', '$fav_id')");
header("Location: search.php?msg=Shortlisted");
?>