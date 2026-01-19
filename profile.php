<?php 
include('includes/db.php');
include('includes/header.php');

// Agar user login nahi hai to login page par bhej do
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Database se is user ka sara data nikalna
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Photo ka rasta check karna
$user_image = (!empty($user['image']) && $user['image'] != 'default.jpg') ? 'images/' . $user['image'] : 'images/default_avatar.png';
?>

<div style="max-width: 600px; margin: 30px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0px 5px 20px rgba(0,0,0,0.1); font-family: Arial; border: 1px solid #eee;">
    
    <div style="text-align: center; margin-bottom: 20px;">
        <h2 style="color: #e67e22; margin-bottom: 5px;">Aan ji Profile</h2>
        <p style="color: #777; font-size: 14px;">Sindhi Marriage Bureau Member</p>
    </div>

    <!-- 1. Profile Photo Display -->
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="<?php echo $user_image; ?>" alt="Profile Photo" style="width: 150px; height: 150px; border-radius: 50%; border: 5px solid #e67e22; object-fit: cover; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
        
        <!-- Photo Upload Form -->
        <form action="upload_photo.php" method="POST" enctype="multipart/form-data" style="margin-top: 15px; background: #fdf2e9; padding: 15px; border-radius: 10px; border: 1px dashed #e67e22;">
            <label style="font-weight: bold; font-size: 13px; display: block; margin-bottom: 5px;">Photo Tabdeel Karein:</label>
            <input type="file" name="my_image" required style="font-size: 12px;">
            <button type="submit" name="submit" style="background: #e67e22; color: white; border: none; padding: 5px 15px; border-radius: 5px; cursor: pointer; font-size: 13px; margin-top: 5px;">Upload 📤</button>
        </form>
    </div>

    <hr style="border: 0; height: 1px; background: #eee; margin: 20px 0;">

    <!-- 2. User Details Display -->
    <div style="line-height: 1.8; font-size: 16px; color: #333;">
        <p><strong>Pura Naam:</strong> <?php echo $user['fullname']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Jins (Gender):</strong> <?php echo $user['gender']; ?></p>
        <p><strong>Zat (Caste):</strong> <?php echo $user['caste']; ?></p>
        <p><strong>Zila (District):</strong> <?php echo $user['district']; ?></p>
        <p><strong>Taleem:</strong> <?php echo $user['education_level']; ?></p>
        <p><strong>Sarparast:</strong> <?php echo $user['guardian_name']; ?> (<?php echo $user['guardian_relation']; ?>)</p>
        
        <!-- Account Status (Naya Feature) -->
        <p><strong>Account Status:</strong> 
            <span style="color: <?php echo ($user['status'] == 'Approved') ? 'green' : 'orange'; ?>; font-weight: bold;">
                <?php echo $user['status']; ?>
            </span>
        </p>
    </div>

    <hr style="border: 0; height: 1px; background: #eee; margin: 20px 0;">

    <!-- 3. Navigation Buttons -->
    <div style="text-align: center; display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
        <a href="edit_profile.php" style="background: #27ae60; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Edit Profile 📝</a>
        
        <a href="dashboard.php" style="background: #34495e; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Dashboard 🏠</a>
    </div>

    <div style="text-align: center; margin-top: 25px;">
        <a href="index.php" style="color: #888; text-decoration: none; font-size: 13px;">← Wapas Home Par Jao</a>
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