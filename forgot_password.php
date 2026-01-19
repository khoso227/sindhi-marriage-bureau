<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include('includes/header.php'); 
?>

<!-- AI Generated Style High-Tech Background -->
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; 
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
    url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=2070&auto=format&fit=crop') no-repeat center center fixed; 
    background-size: cover; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif; margin-top: -20px;">

    <div style="background: rgba(255, 255, 255, 0.1); 
        backdrop-filter: blur(15px); 
        -webkit-backdrop-filter: blur(15px);
        padding: 50px 35px; 
        border-radius: 30px; 
        box-shadow: 0 25px 50px rgba(0,0,0,0.5); 
        width: 100%; 
        max-width: 420px; 
        text-align: center; 
        border: 1px solid rgba(255,255,255,0.2); 
        box-sizing: border-box;">
        
        <!-- Golden Key Icon -->
        <div style="background: linear-gradient(45deg, #e67e22, #f1c40f); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 20px rgba(230,126,34,0.4);">
            <span style="font-size: 40px; filter: drop-shadow(2px 2px 2px rgba(0,0,0,0.3));">🔑</span>
        </div>

        <h1 style="color: #fff; margin: 0; font-size: 28px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">Recover Account</h1>
        <p style="color: rgba(255,255,255,0.8); font-size: 14px; margin-top: 5px; margin-bottom: 35px;">Email aur CNIC se tasdeeq karein</p>

        <form action="reset_logic.php" method="POST">
            
            <!-- Email Input -->
            <div style="text-align: left; margin-bottom: 20px;">
                <label style="font-weight: bold; color: #fff; font-size: 13px; margin-left: 5px;">EMAIL ADDRESS:</label>
                <input type="email" name="email" placeholder="example@mail.com" required 
                style="width: 100%; padding: 15px; border: none; border-radius: 12px; margin-top: 8px; box-sizing: border-box; font-size: 16px; outline: none; background: rgba(255,255,255,0.9);">
            </div>
            
            <!-- CNIC Input -->
            <div style="text-align: left; margin-bottom: 30px;">
                <label style="font-weight: bold; color: #fff; font-size: 13px; margin-left: 5px;">CNIC NUMBER:</label>
                <input type="text" name="cnic" placeholder="42xxx-xxxxxxx-x" required 
                style="width: 100%; padding: 15px; border: none; border-radius: 12px; margin-top: 8px; box-sizing: border-box; font-size: 16px; outline: none; background: rgba(255,255,255,0.9);">
            </div>

            <button type="submit" name="check_user" style="width: 100%; padding: 16px; background: linear-gradient(to right, #e67e22, #d35400); color: white; border: none; border-radius: 12px; font-size: 18px; font-weight: bold; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(230, 126, 34, 0.4); text-transform: uppercase;">
                Verify & Reset (تصديق ڪريو)
            </button>
        </form>

        <div style="margin-top: 30px;">
            <a href="login.php" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px; font-weight: 500; transition: 0.3s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                ← Wapas Login Par Jao
            </a>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>