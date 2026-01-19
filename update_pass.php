<?php
include('includes/db.php');
if (isset($_POST['do_reset'])) {
    $id = $_POST['user_id'];
    $pass = $_POST['new_pass'];

    $sql = "UPDATE users SET password='$pass' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Mubarak Ho! Password badal gaya hai. Ab naye password se login karein.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>