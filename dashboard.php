<?php 
include('includes/db.php');
include('includes/header.php');

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
$my_id = $_SESSION['user_id'];

// 1. DATA GATHERING
$user_res = mysqli_query($conn, "SELECT * FROM users WHERE id='$my_id'");
$user = mysqli_fetch_assoc($user_res);

// 2. PROFILE COMPLETENESS LOGIC
$score = 0;
if(!empty($user['image'])) $score += 20;
if(!empty($user['about_me'])) $score += 20;
if(!empty($user['education'])) $score += 20;
if(!empty($user['occupation'])) $score += 20;
if(!empty($user['video_link'])) $score += 20;

// 3. PREMIUM & TRIAL COUNTDOWN
$days_left = 0; $trial_message = "";
if($user['is_premium'] == 1 && !empty($user['premium_expiry'])) {
    $today = new DateTime();
    $expiry = new DateTime($user['premium_expiry']);
    $diff = $today->diff($expiry);
    $days_left = (int)$diff->format("%r%a");
} else {
    $join_time = strtotime($user['created_at']);
    $hours_passed = (time() - $join_time) / 3600;
    $trial_rem = round(72 - $hours_passed);
    $trial_message = ($trial_rem > 0) ? $trial_rem . " Hours Left" : "Expired";
}

// 4. STATS & NOTIFICATIONS
$total_res = mysqli_query($conn, "SELECT count(*) as total FROM users WHERE id != '$my_id'");
$total_rishta = mysqli_fetch_assoc($total_res)['total'];
$notif_res = mysqli_query($conn, "SELECT count(*) as total FROM requests WHERE receiver_id = '$my_id' AND status = 'Pending'");
$notif_count = mysqli_fetch_assoc($notif_res)['total'];

// 5. AI MATCHMAKING LOGIC (Zat, Mazhab, Zila)
$my_caste = $user['caste']; $my_rel = $user['religion']; $my_dist = $user['district'];
$ai_query = "SELECT * FROM users WHERE id != '$my_id' 
            AND (caste = '$my_caste' OR religion = '$my_rel' OR district = '$my_dist') 
            ORDER BY (caste = '$my_caste') DESC LIMIT 5";
$ai_matches = mysqli_query($conn, $ai_query);

// 6. SUGGESTED PROFILES (RANDOM)
$suggested_profiles = mysqli_query($conn, "SELECT * FROM users WHERE id != '$my_id' ORDER BY RAND() LIMIT 10");
?>

<style>
    body { font-size: 14px; background: #fdf2e9; } /* Sleek small fonts */
    .profile-scroll::-webkit-scrollbar { display: none; }
    .profile-scroll { -ms-overflow-style: none; scrollbar-width: none; display: flex; overflow-x: auto; gap: 15px; padding: 10px 0; }
    .card-vibe { transition: 0.3s; border: 1px solid #eee; }
    .card-vibe:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div style="min-height: 100vh; padding-bottom: 60px;">
    
    <!-- 1. HERO HEADER -->
    <div style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('images/bride_bg.jpg') center; background-size: cover; padding: 50px 20px; color: white; border-bottom: 5px solid #e67e22;">
        <div style="max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <div>
                <h1 style="margin: 0; font-size: 26px; font-weight: 800;">Welcome, <?php echo $user['fullname']; ?>!</h1>
                <?php if($user['is_premium'] == 1): ?>
                    <div style="background: #f1c40f; color: #000; padding: 4px 12px; border-radius: 20px; margin-top: 10px; font-weight: bold; display: inline-block; font-size: 12px;">👑 GOLD MEMBER: <?php echo $days_left; ?> Days Left</div>
                <?php else: ?>
                    <p style="margin: 8px 0 0; opacity: 0.8; font-size: 13px;">Available Matches: <b><?php echo $total_rishta; ?></b></p>
                <?php endif; ?>
            </div>
            <a href="requests_manager.php" style="position: relative; text-decoration: none; font-size: 30px; background: rgba(255,255,255,0.1); padding: 12px; border-radius: 50%;">
                🔔 <span style="position: absolute; top: 0; right: 0; background: #e67e22; color: #fff; border-radius: 50%; font-size: 11px; padding: 2px 6px; font-weight: bold; border: 2px solid #000;"><?php echo $notif_count; ?></span>
            </a>
        </div>
    </div>

    <div style="max-width: 1100px; margin: -30px auto 0; padding: 0 15px;">
        
        <!-- 2. PROFILE STRENGTH METER -->
        <div style="background: white; padding: 15px 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 25px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-weight: 600; font-size: 12px; color: #555;">
                <span>Profile Strength (پروفائل جي مڪمليت)</span>
                <span style="color: #e67e22;"><?php echo $score; ?>%</span>
            </div>
            <div style="width: 100%; background: #eee; height: 6px; border-radius: 10px; overflow: hidden;">
                <div style="width: <?php echo $score; ?>%; background: linear-gradient(to right, #e67e22, #27ae60); height: 100%; transition: 1.5s;"></div>
            </div>
        </div>

        <!-- 3. STATS GRID -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
            <div style="background: white; padding: 20px; border-radius: 15px; text-align: center; border-bottom: 4px solid #3498db; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <h2 style="margin: 0; color: #3498db; font-size: 28px;"><?php echo ($total_rishta + 15); ?></h2>
                <p style="margin: 2px 0; color: #888; font-size: 12px; font-weight: 600;">Profile Visitors</p>
            </div>
            <div style="background: white; padding: 20px; border-radius: 15px; text-align: center; border-bottom: 4px solid #e74c3c; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <h2 style="margin: 0; color: #e74c3c; font-size: 28px;">0</h2>
                <p style="margin: 2px 0; color: #888; font-size: 12px; font-weight: 600;">Favorites ❤️</p>
            </div>
        </div>

        <!-- 4. UPGRADE BANNER (IF FREE) -->
        <?php if($user['is_premium'] == 0): ?>
            <div style="background: linear-gradient(135deg, #e67e22, #f39c12); padding: 25px; border-radius: 15px; color: white; text-align: center; box-shadow: 0 10px 25px rgba(230,126,34,0.3); margin-bottom: 30px; border: 2px solid #fff;">
                <h3 style="margin: 0; font-size: 18px;">Unlock All Contacts 💎</h3>
                <p style="margin: 5px 0 15px; font-size: 13px; opacity: 0.9;">Trial Status: <b><?php echo $trial_message; ?></b></p>
                <a href="packages.php" style="display: inline-block; background: #2c3e50; color: #fff; text-decoration: none; padding: 10px 30px; border-radius: 30px; font-weight: 800; font-size: 12px; text-transform: uppercase;">UPGRADE NOW</a>
            </div>
        <?php endif; ?>

        <!-- 5. AI RECOMMENDATIONS -->
        <div style="margin-bottom: 35px; background: #fff; padding: 20px; border-radius: 15px; border-left: 6px solid #f1c40f; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <h3 style="margin: 0 0 15px 0; color: #2c3e50; font-size: 16px;">✨ Sahil & Arman AI Matches</h3>
            <div class="profile-scroll">
                <?php while($match = mysqli_fetch_assoc($ai_matches)): 
                    $m_img = (!empty($match['image'])) ? "uploads/".$match['image'] : "images/default_user.png"; ?>
                    <div style="min-width: 170px; background: #fdf2e9; padding: 15px; border-radius: 12px; text-align: center; border: 1px solid #e67e22;">
                        <img src="<?php echo $m_img; ?>" style="width: 55px; height: 55px; border-radius: 50%; border: 2px solid #e67e22; object-fit: cover;">
                        <h4 style="font-size: 13px; margin: 8px 0 3px;"><?php echo $match['fullname']; ?></h4>
                        <small style="display:block; color: #e67e22; font-weight: bold; font-size: 10px;"><?php echo $match['caste']; ?></small>
                        <a href="view_profile.php?id=<?php echo $match['id']; ?>" style="display:inline-block; margin-top:10px; font-size: 10px; text-decoration: none; background: #e67e22; color: #fff; padding: 5px 12px; border-radius: 4px; font-weight: bold;">View Match</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- 6. SUGGESTED PROFILES -->
        <div style="margin-bottom: 35px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <h3 style="color: #2c3e50; font-size: 16px; margin: 0;">Suggested Profiles</h3>
                <a href="search.php" style="color: #e67e22; text-decoration: none; font-weight: bold; font-size: 12px;">Explore All →</a>
            </div>
            <div class="profile-scroll">
                <?php while($row = mysqli_fetch_assoc($suggested_profiles)): 
                    $img = (!empty($row['image'])) ? "uploads/".$row['image'] : "images/default_user.png"; ?>
                    <div class="card-vibe" style="min-width: 190px; background: white; padding: 15px; border-radius: 15px; text-align: center;">
                        <img src="<?php echo $img; ?>" style="width: 75px; height: 75px; border-radius: 50%; border: 2px solid #eee; object-fit: cover; filter: blur(3px);">
                        <h4 style="margin: 8px 0 3px; color: #2c3e50; font-size: 14px;"><?php echo $row['fullname']; ?></h4>
                        <p style="font-size: 10px; color: #888; margin-bottom: 12px;"><?php echo $row['caste']; ?> | <?php echo $row['district']; ?></p>
                        <a href="view_profile.php?id=<?php echo $row['id']; ?>" style="font-size: 11px; color: #3498db; text-decoration: none; font-weight: bold;">View Profile</a>
                    </div>
                <?php endwhile; ?>
                <a href="search.php" style="text-decoration: none; min-width: 140px;">
                    <div style="height: 100%; min-height: 160px; background: #2c3e50; border-radius: 15px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 24px;">➕</span><b style="font-size: 11px; margin-top: 5px;">SEE ALL</b>
                    </div>
                </a>
            </div>
        </div>

        <!-- 7. MAIN ACTION BUTTONS -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
            <a href="search.php" style="text-decoration: none;">
                <div style="background: #e67e22; color: white; padding: 30px 10px; border-radius: 15px; text-align: center; box-shadow: 0 10px 20px rgba(230,126,34,0.2);">
                    <h3 style="margin: 0; font-size: 18px;">Find Match 🔍</h3>
                </div>
            </a>
            <a href="profile.php" style="text-decoration: none;">
                <div style="background: #2c3e50; color: white; padding: 30px 10px; border-radius: 15px; text-align: center; box-shadow: 0 10px 20px rgba(44,62,80,0.2);">
                    <h3 style="margin: 0; font-size: 18px;">My Profile 👤</h3>
                </div>
            </a>
        </div>

        <!-- 8. INBOX BUTTON -->
        <a href="requests_manager.php" style="text-decoration: none;">
            <div style="background: #fff; border: 2px solid #2c3e50; color: #2c3e50; padding: 15px; border-radius: 15px; text-align: center; font-weight: bold; font-size: 15px; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                📩 OPEN MESSAGES / INBOX 
                <?php if($notif_count > 0): ?>
                    <span style="background: #e74c3c; color: #fff; padding: 2px 10px; border-radius: 20px; font-size: 11px;">New: <?php echo $notif_count; ?></span>
                <?php endif; ?>
            </div>
        </a>

    </div>
</div>

<?php include('includes/footer.php'); ?>