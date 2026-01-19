<?php
include('includes/db.php');
session_start();

// 1. Login Check
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$my_id = $_SESSION['user_id'];

// 2. Inputs Pakarna
if (!isset($_GET['id']) || !isset($_GET['action'])) {
    header("Location: dashboard.php");
    exit();
}

$target_id = mysqli_real_escape_string($conn, $_GET['id']);
$action = mysqli_real_escape_string($conn, $_GET['action']);

// --- ACTION: SEND REQUEST ---
if ($action == 'send') {

    // A. Apne aap ko bhejney se rokna
    if ($my_id == $target_id) {
        echo "<script>alert('Aap apne aap ko request nahi bhej sakte!'); window.location='search.php';</script>";
        exit();
    }

    // B. Check karein ke kahin pehle se request bheji to nahi hui?
    $check_dup = mysqli_query($conn, "SELECT id FROM requests WHERE sender_id = '$my_id' AND receiver_id = '$target_id'");
    if (mysqli_num_rows($check_dup) > 0) {
        echo "<script>alert('Aap pehle hi is umeedwar ko request bhej chuke hain.'); window.location='search.php';</script>";
        exit();
    }

    // C. Check karein user ne TOTAL kitni requests bhej di hain
    $count_res = mysqli_query($conn, "SELECT count(*) as total FROM requests WHERE sender_id = '$my_id'");
    $count_data = mysqli_fetch_assoc($count_res);
    $sent_count = (int)$count_data['total'];

    // D. User ki apni limit nikalna (Jo admin set karega)
    $me_res = mysqli_query($conn, "SELECT requests_limit, is_premium FROM users WHERE id = '$my_id'");
    $me = mysqli_fetch_assoc($me_res);
    $my_limit = (int)$me['requests_limit'];

    // E. BLOCKING LOGIC (Business Logic)
    if ($sent_count >= $my_limit) {
        if ($my_limit <= 2) {
            // Agar sirf 2 free wali limit par hai
            echo "<script>alert('Mubarak Ho! Aap ki 2 muft requests mukammal ho chuki hain. 3rd request bhejney ke liye 500 PKR tax ada karein.'); window.location='packages.php';</script>";
        } else {
            // Agar recharge wala plan khatam ho gaya hai
            echo "<script>alert('Aap ki plan limit ($my_limit) khatam ho gayi hai. Mazeed requests ke liye account recharge karein.'); window.location='packages.php';</script>";
        }
        exit();
    }

    // F. Request bhej dein
    $sql = "INSERT INTO requests (sender_id, receiver_id, status) VALUES ('$my_id', '$target_id', 'Pending')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Rishta Request kamyabi se bhej di gayi hai!'); window.location='view_profile.php?id=$target_id';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} 
// --- ACTION: ACCEPT / REJECT ---
else {
    $req_id = $target_id; // Yahan ID request ki hoti hai
    
    // Sirf wahi banda accept kare jis ko aayi hai (Security)
    $update_sql = "UPDATE requests SET status = '$action' WHERE id = '$req_id' AND receiver_id = '$my_id'";
    
    if (mysqli_query($conn, $update_sql)) {
        header("Location: requests_manager.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>