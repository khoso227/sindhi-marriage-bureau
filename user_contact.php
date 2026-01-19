<?php 
include('includes/db.php');
include('includes/header.php');

if (!isset($_SESSION['user_id'])) { 
    echo "<script>window.location='login.php';</script>";
    exit(); 
}

$my_id = (int)$_SESSION['user_id'];
$to_id = (int)$_GET['receiver_id'];

// Paigham Bhejna (Safe Logic)
if(isset($_POST['send'])){
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);
    if(!empty($msg)){
        mysqli_query($conn, "INSERT INTO messages (sender_id, receiver_id, message) VALUES ($my_id, $to_id, '$msg')");
        echo "<script>window.location='user_contact.php?receiver_id=$to_id';</script>";
        exit();
    }
}

// User Information
$user_res = mysqli_query($conn, "SELECT fullname FROM users WHERE id = $to_id");
$user_data = mysqli_fetch_assoc($user_res);

// Messages History
$msgs_res = mysqli_query($conn, "SELECT * FROM messages WHERE (sender_id=$my_id AND receiver_id=$to_id) OR (sender_id=$to_id AND receiver_id=$my_id) ORDER BY id ASC");
?>

<div style="max-width: 550px; margin: 30px auto; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; height: 85vh; display: flex; flex-direction: column;">
    
    <div style="background: #e67e22; color: white; padding: 15px; text-align: center; font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
        <a href="requests_manager.php" style="color: white; text-decoration: none; font-size: 13px;">← Wapas</a>
        <span>Chat: <?php echo htmlspecialchars($user_data['fullname']); ?></span>
        <span>💬</span>
    </div>

    <div style="flex: 1; overflow-y: scroll; padding: 20px; background: #fdf2e9;" id="box">
        <?php if(mysqli_num_rows($msgs_res) > 0): ?>
            <?php while($m = mysqli_fetch_assoc($msgs_res)): ?>
                <div style="text-align:<?php echo ($m['sender_id'] == $my_id)? 'right' : 'left'; ?>; margin-bottom: 15px;">
                    <div style="display: inline-block; padding: 10px 15px; border-radius: 15px; background:<?php echo ($m['sender_id'] == $my_id)? '#dcf8c6' : '#fff'; ?>; box-shadow: 0 2px 5px rgba(0,0,0,0.05); max-width: 80%; text-align:left;">
                        <span style="font-size: 15px;"><?php echo htmlspecialchars($m['message']); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; color: #999; margin-top: 50%;">Baat-cheet shuru karein!</p>
        <?php endif; ?>
    </div>

    <form method="POST" style="padding: 15px; background: #fff; display: flex; gap: 10px; border-top: 1px solid #eee;">
        <input type="text" name="msg" placeholder="Likhien..." required autocomplete="off" style="flex: 1; padding: 12px; border-radius: 25px; border: 1px solid #ddd; outline: none;">
        <button type="submit" name="send" style="background: #e67e22; color: white; border: none; padding: 10px 20px; border-radius: 25px; cursor: pointer; font-weight: bold;">Bhejo</button>
    </form>
</div>

<script>
    var obj = document.getElementById("box");
    obj.scrollTop = obj.scrollHeight;
</script>

<?php include('includes/footer.php'); ?>