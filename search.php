<?php 
include('includes/db.php');
include('includes/header.php');

// 1. Session Check
if (!isset($_SESSION['user_id'])) { 
    echo "<script>window.location='login.php';</script>"; 
    exit(); 
}

$u_id = $_SESSION['user_id'];

// 2. --- 🛡️ MUKAMMAL TRIAL & PREMIUM LOGIC ---
$u_check = mysqli_query($conn, "SELECT created_at, is_premium FROM users WHERE id='$u_id'");
$u_data = mysqli_fetch_assoc($u_check);

if((int)$u_data['is_premium'] === 0) {
    $join_time = strtotime($u_data['created_at']);
    // Agar date khali ya ghalat hai to fix karein
    if(empty($u_data['created_at']) || $u_data['created_at'] == '0000-00-00 00:00:00' || $join_time <= 0){
        mysqli_query($conn, "UPDATE users SET created_at = NOW() WHERE id = '$u_id'");
        $join_time = time();
    }
    
    $diff_hours = (time() - $join_time) / 3600;
    if($diff_hours > 72) {
        echo "<script>alert('Aap ka 72-ghante ka trial khatam ho gaya hai. Agay barhne ke liye fees ada karein.'); window.location='packages.php';</script>";
        exit();
    }
}
// --- END TRIAL CHECK ---

// 3. --- 🔍 MANUAL SEARCH FILTERING LOGIC ---
$where = "WHERE id != '$u_id'"; 

if(isset($_GET['filter_search'])){
    if(!empty($_GET['gender'])) { $g = mysqli_real_escape_string($conn, $_GET['gender']); $where .= " AND gender='$g'"; }
    if(!empty($_GET['religion'])) { $r = mysqli_real_escape_string($conn, $_GET['religion']); $where .= " AND religion LIKE '%$r%'"; }
    if(!empty($_GET['caste'])) { $c = mysqli_real_escape_string($conn, $_GET['caste']); $where .= " AND caste LIKE '%$c%'"; }
    if(!empty($_GET['district'])) { $d = mysqli_real_escape_string($conn, $_GET['district']); $where .= " AND district LIKE '%$d%'"; }
    if(!empty($_GET['tehsil'])) { $t = mysqli_real_escape_string($conn, $_GET['tehsil']); $where .= " AND tehsil LIKE '%$t%'"; }
    if(!empty($_GET['min_age'])) { $min = (int)$_GET['min_age']; $where .= " AND age >= $min"; }
    if(!empty($_GET['max_age'])) { $max = (int)$_GET['max_age']; $where .= " AND age <= $max"; }
}

// 4. --- 📄 PAGINATION LOGIC (10 Profiles per page) ---
$limit = 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Total counts nikalna pagination ke liye
$count_query = "SELECT count(*) as total FROM users $where";
$total_res = mysqli_query($conn, $count_query);
$total_data = mysqli_fetch_assoc($total_res);
$total_rows = $total_data['total'];
$total_pages = ceil($total_rows / $limit);

// Main Query with Limit & Offset
$query = "SELECT * FROM users $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
$results = mysqli_query($conn, $query);
?>

<div style="background: #fdf2e9; min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif; padding-bottom: 60px;">
    
    <!-- Top Header Banner -->
    <div style="width: 100%; height: 160px; background: url('images/bride_bg.jpg') no-repeat center center; background-size: cover; border-bottom: 5px solid #e67e22; box-shadow: 0 4px 12px rgba(0,0,0,0.2);"></div>

    <div style="max-width: 1200px; margin: -50px auto 0; position: relative; z-index: 10; padding: 0 15px;">
        
        <!-- 📄 MANUAL SEARCH BOX -->
        <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.15); border-top: 8px solid #e67e22;">
            <h2 style="color: #2c3e50; text-align: center; margin-bottom: 25px;">🔍 Jeevan Sathi ki Talash (ڳولا ڪريو)</h2>
            
            <form method="GET">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; align-items: flex-end;">
                    
                    <div>
                        <label style="font-weight:bold; font-size:12px;">Gender:</label>
                        <select name="gender" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                            <option value="">All (سڀ)</option>
                            <option value="Mard">Mard / گھوٽ</option>
                            <option value="Khatoon">Khatoon / ڪنوار</option>
                        </select>
                    </div>

                    <div>
                        <label style="font-weight:bold; font-size:12px;">Religion (مذهب):</label>
                        <input type="text" name="religion" placeholder="Muslim, Hindu..." style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    </div>

                    <div>
                        <label style="font-weight:bold; font-size:12px;">Caste (ذات):</label>
                        <input type="text" name="caste" placeholder="Zat likhein" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    </div>

                    <div>
                        <label style="font-weight:bold; font-size:12px;">District (ضلعو):</label>
                        <input type="text" name="district" placeholder="Zila likhein" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    </div>

                    <div>
                        <label style="font-weight:bold; font-size:12px;">Tehsil (تحصيل):</label>
                        <input type="text" name="tehsil" placeholder="Tehsil likhein" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    </div>

                    <div style="display:flex; gap:5px;">
                        <input type="number" name="min_age" placeholder="Min Age" style="width:50%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                        <input type="number" name="max_age" placeholder="Max Age" style="width:50%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    </div>

                    <button type="submit" name="filter_search" style="padding:15px; background:#e67e22; color:white; border:none; border-radius:10px; font-weight:bold; cursor:pointer; font-size:16px;">
                        SEARCH 🔍
                    </button>
                </div>
            </form>
        </div>

        <!-- 🖼️ RESULTS GRID -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; margin-top: 50px;">
            <?php if(mysqli_num_rows($results) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($results)): 
                    $user_img = (!empty($row['image'])) ? "uploads/".$row['image'] : "images/default_user.png";
                ?>
                <div style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.08); border-bottom: 5px solid #e67e22; text-align: center;">
                    <div style="height: 200px; overflow: hidden; background: #f0f0f0;">
                        <img src="<?php echo $user_img; ?>" style="width: 100%; height: 100%; object-fit: cover; filter: blur(3px);">
                    </div>
                    <div style="padding: 20px;">
                        <span style="background:#2c3e50; color:#fff; padding:3px 10px; border-radius:10px; font-size:11px;"><?php echo $row['religion']; ?></span>
                        <h3 style="margin: 10px 0 5px; color:#333; font-size: 20px;"><?php echo $row['fullname']; ?></h3>
                        <p style="color:#e67e22; font-weight:bold; margin:0;"><?php echo $row['caste']; ?></p>
                        <p style="color:#777; font-size:13px; margin-top:5px;">🎂 <?php echo $row['age']; ?> Saal | 📍 <?php echo $row['district']; ?></p>
                        <a href="view_profile.php?id=<?php echo $row['id']; ?>" style="display:block; margin-top:15px; padding:12px; background:#27ae60; color:white; text-decoration:none; border-radius:10px; font-weight:bold;">DETAILS DEKHO</a>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 80px; background: white; border-radius: 20px;">
                    <h3>Maafi! Koi umeedwar nahi mila.</h3>
                </div>
            <?php endif; ?>
        </div>

        <!-- --- SEE MORE / PAGINATION --- -->
        <div style="text-align: center; margin-top: 50px;">
            <?php 
                // Filter parameters ko link mein barkarar rakhne ke liye
                $params = $_GET;
                unset($params['page']);
                $query_string = http_build_query($params);
            ?>

            <?php if ($page > 1): ?>
                <a href="search.php?page=<?php echo $page - 1; ?>&<?php echo $query_string; ?>" style="padding: 12px 30px; background: #2c3e50; color: white; text-decoration: none; border-radius: 50px; margin-right: 10px; font-weight: bold;">← Previous</a>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="search.php?page=<?php echo $page + 1; ?>&<?php echo $query_string; ?>" style="padding: 12px 40px; background: #e67e22; color: white; text-decoration: none; border-radius: 50px; font-weight: bold; box-shadow: 0 5px 15px rgba(230,126,34,0.3);">See More Profiles (اڳتي ڏسو) →</a>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>