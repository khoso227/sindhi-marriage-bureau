<?php
include('includes/db.php');
session_start();

// 1. Check karein ke user log-in hai
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sender_id = $_SESSION['user_id'];

// 2. "to" parameter check karein (URL se id lein)
if (isset($_GET['to'])) {
    $receiver_id = mysqli_real_escape_string($conn, $_GET['to']);

    // 3. Check karein ke kahin user khud ko hi request to nahi bhej raha?
    if ($sender_id == $receiver_id) {
        echo "<script>alert('Aap khud ko request nahi bhej sakte!'); window.location='search.php';</script>";
        exit();
    }

    // 4. Check karein ke kya pehle se request bheji hui hai?
    $check_query = "SELECT * FROM requests WHERE (sender_id = '$sender_id' AND receiver_id = '$receiver_id') OR (sender_id = '$receiver_id' AND receiver_id = '$sender_id')";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Aap pehle hi is user se rabta kar chuke hain!'); window.location='search.php';</script>";
    } else {
        // 5. Nayi request insert karein
        $insert_query = "INSERT INTO requests (sender_id, receiver_id, status) VALUES ('$sender_id', '$receiver_id', 'Pending')";
        
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('Rishta Request kamyabi se bhej di gayi hai!'); window.location='search.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: search.php");
}
?>