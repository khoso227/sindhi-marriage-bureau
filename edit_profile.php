<?php 
// No extra session_start here as it's in header.php
include('includes/db.php');
include('includes/header.php');

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
$u_id = $_SESSION['user_id'];

// --- 1. DATA FETCH ---
$user_res = mysqli_query($conn, "SELECT * FROM users WHERE id='$u_id'");
$user = mysqli_fetch_assoc($user_res);

// --- 2. UPDATE LOGIC ---
if(isset($_POST['update_profile'])){
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $age      = (int)$_POST['age'];
    $cnic     = mysqli_real_escape_string($conn, $_POST['cnic']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $sect     = mysqli_real_escape_string($conn, $_POST['sect'] ?? '');
    $caste    = mysqli_real_escape_string($conn, $_POST['caste']);
    $division = mysqli_real_escape_string($conn, $_POST['division']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $tehsil   = mysqli_real_escape_string($conn, $_POST['tehsil']);
    $edu      = mysqli_real_escape_string($conn, $_POST['education']);
    $occ      = mysqli_real_escape_string($conn, $_POST['occupation']);
    $bio      = mysqli_real_escape_string($conn, $_POST['about_me']);
    $marital  = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $gender   = mysqli_real_escape_string($conn, $_POST['gender']);

    // Video Upload Logic
    $video_name = $user['video_link'];
    if(!empty($_FILES['intro_video']['name'])){
        $file_tmp = $_FILES['intro_video']['tmp_name'];
        $file_ext = strtolower(pathinfo($_FILES['intro_video']['name'], PATHINFO_EXTENSION));
        $allowed = array('mp4', 'mov', 'avi');

        if(in_array($file_ext, $allowed)){
            $new_vid = "vid_" . $u_id . "_" . time() . "." . $file_ext;
            if(move_uploaded_file($file_tmp, "videos/" . $new_vid)){
                $video_name = $new_vid; 
            }
        }
    }

    $update_sql = "UPDATE users SET 
        fullname='$fullname', phone='$phone', age='$age', candidate_cnic='$cnic', 
        religion='$religion', sect='$sect', caste='$caste', 
        division='$division', district='$district', tehsil='$tehsil',
        education='$edu', occupation='$occ', about_me='$bio', 
        marital_status='$marital', gender='$gender', video_link='$video_name' 
        WHERE id='$u_id'";

    if(mysqli_query($conn, $update_sql)){
        alertMe('success', 'Saved!', 'Aap ki profile update ho gayi hai.', 'profile.php');
    }
}
?>

<div style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/bride_bg.jpg') no-repeat center center fixed; background-size: cover; padding: 40px 10px; min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif;">
    
    <div style="max-width: 950px; margin: 0 auto; background: rgba(255, 255, 255, 0.98); padding: 40px; border-radius: 25px; box-shadow: 0 20px 50px rgba(0,0,0,0.5); border-top: 10px solid #e67e22;">
        
        <!-- Strict Hidayat Board -->
        <div style="background: #fff5f5; border: 2px solid #c0392b; padding: 20px; border-radius: 12px; margin-bottom: 30px;">
            <h3 style="color: #c0392b; margin-top: 0;">⚠️ SAKHT HIDAYAT</h3>
            <p style="font-size: 14px; color: #333; margin:0;">Poori malomat dena lazmi hai. CNIC aur WhatsApp sahi likhein warna account block ho jayega.</p>
        </div>

        <h2 style="text-align: center; color: #e67e22; font-size: 28px;">Edit Professional Profile</h2>

        <form method="POST" enctype="multipart/form-data">
            <!-- Basic Fields Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 25px;">
                <div><label>Full Name:</label><input type="text" name="fullname" value="<?php echo $user['fullname'] ?? ''; ?>" required></div>
                <div><label>WhatsApp No:</label><input type="text" name="phone" value="<?php echo $user['phone'] ?? ''; ?>" required></div>
                <div><label>Age:</label><input type="number" name="age" value="<?php echo $user['age'] ?? ''; ?>" required></div>
                <div><label>CNIC:</label><input type="text" name="cnic" value="<?php echo $user['candidate_cnic'] ?? ''; ?>" required></div>
            </div>

            <!-- Video Section -->
            <div style="background: #fdf2e9; padding: 20px; border-radius: 15px; margin-bottom: 25px; border: 2px dashed #e67e22;">
                <label style="font-weight: bold; color: #d35400;">🎥 Intro Video (Record & Upload):</label>
                <input type="file" name="intro_video" accept="video/*" style="margin-top:10px;">
                <p style="font-size: 11px; color: #666;">(Max: 15MB, Format: MP4)</p>
            </div>

            <!-- Religion & Location Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-bottom: 25px;">
                <input type="text" name="religion" value="<?php echo $user['religion'] ?? ''; ?>" placeholder="Religion" required>
                <input type="text" name="caste" value="<?php echo $user['caste'] ?? ''; ?>" placeholder="Caste" required>
                <input type="text" name="district" value="<?php echo $user['district'] ?? ''; ?>" placeholder="District" required>
            </div>

            <textarea name="about_me" rows="4" placeholder="Bio (Apne bare mein likhein)" style="width:100%; padding:15px; border-radius:10px; border:1px solid #ddd;"><?php echo $user['about_me'] ?? ''; ?></textarea>

            <!-- Hidden Fields for logic consistency -->
            <input type="hidden" name="gender" value="<?php echo $user['gender']; ?>">
            <input type="hidden" name="marital_status" value="<?php echo $user['marital_status']; ?>">
            <input type="hidden" name="division" value="<?php echo $user['division']; ?>">
            <input type="hidden" name="tehsil" value="<?php echo $user['tehsil']; ?>">
            <input type="hidden" name="education" value="<?php echo $user['education']; ?>">
            <input type="hidden" name="occupation" value="<?php echo $user['occupation']; ?>">

            <button type="submit" name="update_profile" style="width: 100%; padding: 20px; background: linear-gradient(to right, #27ae60, #2ecc71); color: white; border: none; border-radius: 15px; font-size: 20px; font-weight: bold; cursor: pointer; margin-top: 30px; box-shadow: 0 10px 20px rgba(39,174,96,0.3);">
                SAVE ALL CHANGES
            </button>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="dashboard.php" style="color: #666; text-decoration: none;">← Back to Dashboard</a>
            </div>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>