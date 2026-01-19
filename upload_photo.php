<?php
include('includes/db.php');
session_start();

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $img_name = $_FILES['my_image']['name'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    
    // Naya naam dena taake files mix na hon
    $new_img_name = "user_" . $user_id . "_" . $img_name;
    $upload_path = "images/" . $new_img_name;

    if (move_uploaded_file($tmp_name, $upload_path)) {
        // Database mein photo ka naam update karna
        mysqli_query($conn, "UPDATE users SET image = '$new_img_name' WHERE id = '$user_id'");
        echo "<script>alert('Mubarak Ho! Tasveer upload ho gayi.'); window.location='profile.php';</script>";
    } else {
        echo "Upload mein masla aaya!";
    }
}
?>