<?php 
include('includes/db.php');
include('includes/header.php');

// 1. Session aur Security Check
if (!isset($_SESSION['user_id'])) { 
    echo "<script>window.location='login.php';</script>"; 
    exit(); 
}

$my_id = $_SESSION['user_id'];
$target_id = mysqli_real_escape_string($conn, $_GET['id']);

// 2. Apni details aur Target User ki details nikalna
$me_res = mysqli_query($conn, "SELECT * FROM users WHERE id = '$my_id'");
$me = mysqli_fetch_assoc($me_res);

$target_res = mysqli_query($conn, "SELECT * FROM users WHERE id = '$target_id'");
$user = mysqli_fetch_assoc($target_res);

if (!$user) { 
    echo "<div style='text-align:center; padding:50px;'><h2>User Not Found!</h2><a href='search.php'>Back to Search</a></div>"; 
    exit(); 
}

// --- 🛡️ 3. TRIAL & PREMIUM BYPASS (THE REAL FIX) ---
$is_vip = (int)$me['is_premium']; // 1 = Premium, 0 = Free

if($is_vip === 0) { 
    // Ye hissa sirf un ke liye chalega jo Premium NAHI hain
    $join_time = strtotime($me['created_at']);
    
    // Agar database mein date ghalat hai (0000-00-00), to aaj se trial shuru karein
    if(empty($me['created_at']) || $me['created_at'] == '0000-00-00 00:00:00' || $join_time <= 0){
        mysqli_query($conn, "UPDATE users SET created_at = NOW() WHERE id = '$my_id'");
        $join_time = time();
    }
    
    $hours_passed = (time() - $join_time) / 3600;
    
    // Agar 72 ghante se zyada ho gaye aur Premium nahi hai, tabhi block karein
    if($hours_passed > 72) {
        echo "<script>alert('Aap ka muft trial khatam ho gaya hai. Agay barhne ke liye plan lein.'); window.location='packages.php';</script>";
        exit();
    }
}
// AGAR PREMIUM HAI TO UPAR WALA POORA KHANDAN SKIP HO JAYEGA!
// --- 🛡️ END TRIAL LOGIC ---

// 4. Photo aur Request status check
$user_img = (!empty($user['image'])) ? "uploads/".$user['image'] : "images/default_user.png";
$req_q = mysqli_query($conn, "SELECT * FROM requests WHERE (sender_id = '$my_id' AND receiver_id = '$target_id') OR (sender_id = '$target_id' AND receiver_id = '$my_id')");
$request = mysqli_fetch_assoc($req_q);
?>

<div style="background: #fdf2e9; padding: 40px 10px; min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif;">
    <div style="max-width: 800px; margin: 0 auto; background: white; border-radius: 25px; box-shadow: 0 15px 45px rgba(0,0,0,0.15); overflow: hidden; border-top: 10px solid #e67e22;">
        
        <!-- Profile Header Section -->
        <div style="background: linear-gradient(45deg, #2c3e50, #34495e); padding: 50px; text-align: center; color: white;">
            <div style="position: relative; display: inline-block;">
                <img src="<?php echo $user_img; ?>" style="width: 180px; height: 180px; border-radius: 50%; border: 6px solid #e67e22; object-fit: cover; background: white; filter: blur(3px);">
                <?php if($user['is_premium'] == 1): ?>
                    <div style="position: absolute; bottom: 10px; right: 10px; background: gold; color: black; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">👑 GOLD</div>
                <?php endif; ?>
            </div>
            <h2 style="margin: 15px 0 5px; font-size: 32px; letter-spacing: 1px;"><?php echo $user['fullname']; ?></h2>
            <p style="font-size: 18px; opacity: 0.8;"><?php echo $user['sect']; ?> (<?php echo $user['caste']; ?>)</p>
        </div>

        <!-- Information Area -->
        <div style="padding: 40px;">
            <h3 style="color: #e67e22; border-bottom: 2px solid #fdf2e9; padding-bottom: 10px; margin-bottom: 30px;">Tafseeli Malomat (Details)</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                <div>
                    <label style="color: #999; font-size: 12px; font-weight: bold; text-transform: uppercase;">Mazhab:</label>
                    <p style="font-size: 17px; margin: 5px 0; color: #333; font-weight: 500;"><?php echo $user['religion']; ?></p>
                </div>
                <div>
                    <label style="color: #999; font-size: 12px; font-weight: bold; text-transform: uppercase;">Age / Umar:</label>
                    <p style="font-size: 17px; margin: 5px 0; color: #333; font-weight: 500;"><?php echo $user['age']; ?> Saal</p>
                </div>
                <div>
                    <label style="color: #999; font-size: 12px; font-weight: bold; text-transform: uppercase;">Zila (District):</label>
                    <p style="font-size: 17px; margin: 5px 0; color: #333; font-weight: 500;"><?php echo $user['district']; ?></p>
                </div>
                <div>
                    <label style="color: #999; font-size: 12px; font-weight: bold; text-transform: uppercase;">Rozgaar (Occupation):</label>
                    <p style="font-size: 17px; margin: 5px 0; color: #27ae60; font-weight: bold;"><?php echo $user['occupation']; ?></p>
                </div>
            </div>

            <!-- 🔒 CONTACT BOX (LOCKED FOR FREE USERS) -->
            <div style="margin-top: 40px; background: #fafafa; padding: 30px; border-radius: 20px; border: 1px dashed #ddd; text-align: center;">
                <h4 style="margin-top: 0; color: #2c3e50;">Contact Number / WhatsApp:</h4>
                
                <?php if($is_vip === 1): ?>
                    <!-- YE TAB DIKHEGA JAB DEKHNE WALA PREMIUM HOGA -->
                    <p style="font-size: 24px; color: #27ae60; font-weight: bold; margin: 10px 0;">
                        📞 <?php echo $user['email']; ?>
                    </p>
                    <p style="font-size: 12px; color: #666;">(Aap Premium member hain, is liye ye contact unlock hai)</p>
                <?php else: ?>
                    <!-- YE FREE USERS KO DIKHEGA -->
                    <div style="padding: 10px;">
                        <p style="color: #c0392b; font-weight: bold; font-size: 18px;">🔒 Number is Hidden</p>
                        <p style="font-size: 13px; color: #777; margin-bottom: 20px;">Premium members can see phone numbers directly.</p>
                        <a href="packages.php" style="background: #2c3e50; color: white; padding: 12px 30px; text-decoration: none; border-radius: 10px; font-weight: bold; font-size: 14px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">Upgrade to Unlock</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Action Buttons Area -->
            <div style="margin-top: 50px; text-align: center;">
                <?php 
                if (!$request) { 
                    echo '<a href="process_request.php?action=send&id='.$target_id.'" style="background: #e67e22; color: white; padding: 18px 50px; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 18px; box-shadow: 0 10px 25px rgba(230,126,34,0.4); display: inline-block;">DILCHASPI ZAHIR KAREIN ❤️</a>';
                } elseif ($request['status'] == 'Pending') {
                    echo '<button disabled style="background: #bdc3c7; color: white; padding: 18px 50px; border: none; border-radius: 50px; font-weight: bold; font-size: 18px;">REQUEST BHEJI GAYI ⏳</button>';
                } elseif ($request['status'] == 'Accepted') {
                    echo '<a href="connect.php?receiver_id='.$target_id.'" style="background: #3498db; color: white; padding: 18px 50px; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 18px; box-shadow: 0 10px 25px rgba(52,152,219,0.3); display: inline-block;">GUFTAGU SHURU KAREIN 💬</a>';
                }
                ?>
                
                <div style="margin-top: 30px;">
                    <a href="search.php" style="color: #999; text-decoration: none; font-size: 14px; font-weight: 500;">← Back to Search Results</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?><?php if(!empty($user['video_link'])): ?>
    <div style="margin-top: 20px; text-align: center;">
        <h4 style="color: #e67e22;">Intro Video 🎥</h4>
        <video width="100%" height="auto" controls style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
            <source src="videos/<?php echo $user['video_link']; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
<?php endif; ?>