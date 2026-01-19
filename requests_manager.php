<?php 
include('includes/db.php');
include('includes/header.php');

// 1. Session Check
if (!isset($_SESSION['user_id'])) { 
    echo "<script>window.location='login.php';</script>";
    exit(); 
}

$my_id = $_SESSION['user_id'];

// 2. Queries
$incoming = mysqli_query($conn, "SELECT r.*, u.fullname, u.caste, u.district FROM requests r JOIN users u ON r.sender_id = u.id WHERE r.receiver_id = '$my_id'");
$outgoing = mysqli_query($conn, "SELECT r.*, u.fullname, u.caste, u.district FROM requests r JOIN users u ON r.receiver_id = u.id WHERE r.sender_id = '$my_id'");
?>

<div style="background: #f4f4f4; min-height: 100vh; padding: 20px 0; font-family: 'Segoe UI', Arial, sans-serif;">
    
    <div style="max-width: 950px; margin: 0 auto 30px; background: #2c3e50; color: white; padding: 25px; border-radius: 15px; text-align: center; border-bottom: 6px solid #e67e22;">
        <h2 style="margin:0; font-family: 'Times New Roman';">بِسْمِ ٱللَّهِ ٱلرَّحْمَـٰنِ ٱلرَّحِيمِ</h2>
        <p style="font-style: italic; margin-top:10px; color: #f39c12;">"Sacho Rishto, Sachi Pehchan - Sindhi Marriage Bureau"</p>
    </div>

    <div style="max-width: 950px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 25px; padding: 0 15px;">
        
        <!-- 📥 MILI HUI REQUESTS -->
        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-top: 5px solid #e67e22;">
            <h3 style="color: #e67e22; border-bottom: 2px solid #eee; padding-bottom: 15px;">📥 Mili hui Requests</h3>
            <?php if(mysqli_num_rows($incoming) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($incoming)): ?>
                    <div style="border: 1px solid #f0f0f0; padding: 15px; margin-bottom: 15px; border-radius: 12px; background: #fafafa;">
                        <strong style="font-size: 18px;"><?php echo htmlspecialchars($row['fullname']); ?></strong>
                        <p style="font-size: 14px; color: #777;"><?php echo htmlspecialchars($row['caste']); ?> | <?php echo htmlspecialchars($row['district']); ?></p>
                        <div style="margin-top: 15px;">
                            <?php if($row['status'] == 'Pending'): ?>
                                <a href="process_request.php?id=<?php echo $row['id']; ?>&action=Accepted" style="background: #27ae60; color: white; padding: 8px 18px; text-decoration: none; border-radius: 6px; font-weight:bold;">Accept ✅</a>
                                <a href="process_request.php?id=<?php echo $row['id']; ?>&action=Rejected" style="background: #c0392b; color: white; padding: 8px 18px; text-decoration: none; border-radius: 6px; font-weight:bold;">Reject</a>
                            <?php else: ?>
                                <span style="font-weight: bold; color: #e67e22;">Status: <?php echo $row['status']; ?></span>
                                <?php if($row['status'] == 'Accepted'): ?>
                                    <!-- FILE NAME CHANGED TO connect.php -->
                                    <a href="connect.php?receiver_id=<?php echo $row['sender_id']; ?>" style="background: #3498db; color: white; padding: 8px 18px; text-decoration: none; border-radius: 6px; font-weight:bold; margin-left: 10px;">Message 💬</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: #bbb; text-align: center;">Koi request nahi aayi.</p>
            <?php endif; ?>
        </div>

        <!-- 📤 BHEJI HUI REQUESTS -->
        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-top: 5px solid #34495e;">
            <h3 style="color: #34495e; border-bottom: 2px solid #eee; padding-bottom: 15px;">📤 Bheji hui Requests</h3>
            <?php if(mysqli_num_rows($outgoing) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($outgoing)): ?>
                    <div style="border: 1px solid #f0f0f0; padding: 15px; margin-bottom: 15px; border-radius: 12px; background: #fafafa;">
                        <strong style="font-size: 18px;"><?php echo htmlspecialchars($row['fullname']); ?></strong>
                        <p style="margin-top: 10px;">
                            <span style="font-weight: bold; color: <?php echo ($row['status'] == 'Accepted' ? 'green' : '#f39c12'); ?>;">Status: <?php echo $row['status']; ?></span>
                            <?php if($row['status'] == 'Accepted'): ?>
                                <!-- FILE NAME CHANGED TO connect.php -->
                                <a href="connect.php?receiver_id=<?php echo $row['receiver_id']; ?>" style="background: #3498db; color: white; padding: 8px 18px; text-decoration: none; border-radius: 6px; font-weight:bold; margin-left: 10px;">Message 💬</a>
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: #bbb; text-align: center;">Aap ne koi request nahi bheji.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>