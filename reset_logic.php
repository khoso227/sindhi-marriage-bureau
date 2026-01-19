<?php
include('includes/db.php');
include('includes/header.php');

if (isset($_POST['check_user'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);

    // Database mein match check karna
    $query = "SELECT * FROM users WHERE email='$email' AND candidate_cnic='$cnic'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User mil gaya! Ab naya password maango
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
?>
        <div style="background: #f4f4f4; height: 80vh; display: flex; align-items: center; justify-content: center;">
            <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; width: 400px;">
                <h2 style="color: #27ae60;">Tasdeeq Kamyab! ✅</h2>
                <p>Ab apna naya password rakhein.</p>
                <form action="update_pass.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="password" name="new_pass" placeholder="Naya Password" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px;">
                    <button type="submit" name="do_reset" style="width: 100%; padding: 15px; background: #27ae60; color: white; border: none; border-radius: 10px; font-weight: bold;">PASSWORD BADLEIN</button>
                </form>
            </div>
        </div>
<?php
    } else {
        echo "<script>alert('Ghalat Malomat! Email ya CNIC match nahi kar raha.'); window.location='forgot_password.php';</script>";
    }
}
?>