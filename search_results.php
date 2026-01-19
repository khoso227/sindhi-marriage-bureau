<?php 
include('includes/db.php');
include('includes/header.php');

// Form se data lena
$religion = isset($_GET['religion']) ? mysqli_real_escape_string($conn, $_GET['religion']) : '';
$sect = isset($_GET['sect']) ? mysqli_real_escape_string($conn, $_GET['sect']) : '';
$caste = isset($_GET['caste']) ? mysqli_real_escape_string($conn, $_GET['caste']) : '';
$district = isset($_GET['district']) ? mysqli_real_escape_string($conn, $_GET['district']) : '';
$min_age = isset($_GET['min_age']) ? (int)$_GET['min_age'] : 18;
$max_age = isset($_GET['max_age']) ? (int)$_GET['max_age'] : 70;

// SQL Query banana (Filters ke sath)
$sql = "SELECT * FROM users WHERE age BETWEEN $min_age AND $max_age";

if($religion != '') { $sql .= " AND religion = '$religion'"; }
if($sect != '') { $sql .= " AND sect = '$sect'"; }
if($caste != '') { $sql .= " AND caste = '$caste'"; }
if($district != '') { $sql .= " AND district = '$district'"; }

// Khud ko search mein na dikhane ke liye (agar login hai)
if(isset($_SESSION['user_id'])) {
    $my_id = $_SESSION['user_id'];
    $sql .= " AND id != '$my_id'";
}

$result = mysqli_query($conn, $sql);
?>

<div style="background: #fdf2e9; min-height: 100vh; padding: 40px 10px;">
    <div style="max-width: 1000px; margin: 0 auto;">
        
        <h2 style="text-align: center; color: #e67e22; margin-bottom: 30px;">
            Search Results (تلاش جا نتيجا)
        </h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            <?php 
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { ?>
                    <!-- Result Card -->
                    <div style="background: white; border-radius: 15px; padding: 20px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-top: 5px solid #e67e22;">
                        <img src="images/default_user.png" style="width: 100px; border-radius: 50%; border: 3px solid #eee; margin-bottom: 15px;">
                        <h3 style="margin: 0; color: #2c3e50;"><?php echo $row['fullname']; ?></h3>
                        <p style="color: #e67e22; font-weight: bold; margin: 5px 0;">
                            <?php echo $row['sect']; ?> (<?php echo $row['caste']; ?>)
                        </p>
                        <p style="font-size: 14px; color: #666;">
                            Age: <?php echo $row['age']; ?> | <?php echo $row['district']; ?>
                        </p>
                        <p style="font-size: 14px; color: #666;">
                            Occupation: <?php echo $row['occupation']; ?>
                        </p>
                        <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">
                        <a href="profile.php?id=<?php echo $row['id']; ?>" style="background: #e67e22; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block; font-weight: bold;">
                            View Profile (پروفائل ڏسو)
                        </a>
                    </div>
                <?php } 
            } else { ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 50px; background: white; border-radius: 15px;">
                    <h3 style="color: #999;">Maaf Kijiye! Is tarah ka koi rishta nahi mila.</h3>
                    <p>Koshish karein ke filters kam lagayein.</p>
                    <a href="search.php" style="color: #e67e22; font-weight: bold;">Dubara Talash Karein</a>
                </div>
            <?php } ?>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>