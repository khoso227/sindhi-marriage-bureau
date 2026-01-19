<?php 
// 1. Session aur DB Connection
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include('includes/db.php');

// 2. Security Check: User ya Admin dono mein se koi aik login hona chahiye
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// 3. Sender Identity (Pehchan karein ke bhejney wala kaun hai?)
if (isset($_SESSION['admin_logged_in'])) {
    $my_id = 0; // Admin ki ID database mein 0 consider hogi
    $is_admin_mode = true;
} else {
    $my_id = $_SESSION['user_id'];
    $is_admin_mode = false;
}

// 4. Receiver ID check (Saamne wale ki ID)
if(!isset($_GET['receiver_id']) || empty($_GET['receiver_id'])){
    echo "<script>alert('Invalid ID!'); window.location='index.php';</script>"; 
    exit();
}
$receiver_id = mysqli_real_escape_string($conn, $_GET['receiver_id']);

// 5. Message Bhejne ka Logic
if(isset($_POST['send_msg'])){
    $msg = mysqli_real_escape_string($conn, $_POST['message']);
    if(!empty($msg)){
        mysqli_query($conn, "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$my_id', '$receiver_id', '$msg')");
        // Page refresh taake naya message foran nazar aaye
        header("Location: connect.php?receiver_id=$receiver_id");
        exit();
    }
}

// 6. Saamne wale ka naam nikalna
if($receiver_id == 0) {
    $receiver_name = "Master Admin (ايڊمن)";
} else {
    $u_res = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$receiver_id'");
    $u_data = mysqli_fetch_assoc($u_res);
    $receiver_name = $u_data['fullname'];
}

// 7. Chat History (Conversation History nikalna)
$msgs = mysqli_query($conn, "SELECT * FROM messages WHERE (sender_id='$my_id' AND receiver_id='$receiver_id') OR (sender_id='$receiver_id' AND receiver_id='$my_id') ORDER BY id ASC");

include('includes/header.php'); 
?>

<div style="background: #fdf2e9; min-height: 100vh; font-family: Arial, sans-serif; padding-top: 20px;">
    
    <!-- Chat Container -->
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #ddd;">
        
        <!-- Chat Header -->
        <div style="background: #e67e22; color: white; padding: 18px; text-align: center; font-weight: bold; font-size: 18px;">
            Guftagu with: <?php echo $receiver_name; ?> 💬
            <?php if($is_admin_mode) echo "<br><small style='font-weight:normal; opacity:0.8;'>(Admin Control Mode)</small>"; ?>
        </div>
        
        <!-- Messages Display Box -->
        <div style="height: 450px; overflow-y: auto; padding: 20px; background: #fffcf9;" id="chat-box">
            <?php if(mysqli_num_rows($msgs) > 0): ?>
                <?php while($m = mysqli_fetch_assoc($msgs)){ 
                    $is_me = ($m['sender_id'] == $my_id);
                ?>
                    <div style="text-align: <?php echo $is_me ? 'right' : 'left'; ?>; margin-bottom: 15px;">
                        <div style="display: inline-block; padding: 12px 18px; border-radius: 18px; max-width: 80%; 
                            background: <?php echo $is_me ? '#e67e22' : '#f1f1f1'; ?>; 
                            color: <?php echo $is_me ? '#fff' : '#333'; ?>;
                            box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align: left;">
                            <?php echo htmlspecialchars($m['message']); ?>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div style="text-align: center; color: #ccc; margin-top: 180px;">
                    <p>No messages yet. Start the conversation!<br>(ڳالهه ٻولهه شروع ڪريو)</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Input Form -->
        <form method="POST" style="padding: 15px; display: flex; gap: 10px; border-top: 1px solid #eee; background: white;">
            <input type="text" name="message" placeholder="Type a message (نياپو لکو)..." required autocomplete="off" style="flex: 1; padding: 12px; border: 1px solid #ddd; border-radius: 25px; outline: none; font-size: 15px;">
            <button type="submit" name="send_msg" style="background: #e67e22; color: white; border: none; padding: 0 25px; border-radius: 25px; cursor: pointer; font-weight: bold; transition: 0.3s;">SEND</button>
        </form>
    </div>
    
    <!-- Back Navigation -->
    <div style="text-align: center; margin-top: 25px; padding-bottom: 30px;">
        <?php if($is_admin_mode): ?>
            <a href="admin/dashboard.php" style="color: #666; text-decoration: none; font-weight: bold;">← Back to Admin Panel (واپس)</a>
        <?php else: ?>
            <a href="requests_manager.php" style="color: #e67e22; text-decoration: none; font-weight: bold; border: 1px solid #e67e22; padding: 8px 20px; border-radius: 20px;">← Back to Inbox (واپس)</a>
        <?php endif; ?>
    </div>
</div>

<script>
    // Auto-scroll to the bottom of the chat
    var objDiv = document.getElementById("chat-box");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>

<?php include('includes/footer.php'); ?>