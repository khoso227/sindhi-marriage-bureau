<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include('includes/header.php'); 
?>

<!-- Cinematic AI Bride & Groom Background -->
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; 
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), 
    url('images/bride_groom_ai.jpg') no-repeat center center fixed; 
    background-size: cover; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif; margin-top: -2px;">

    <!-- Stylish Glassmorphism Card -->
    <div style="background: rgba(255, 255, 255, 0.1); 
        backdrop-filter: blur(15px); 
        -webkit-backdrop-filter: blur(15px);
        padding: 45px 35px; 
        border-radius: 35px; 
        box-shadow: 0 30px 60px rgba(0,0,0,0.6); 
        width: 100%; 
        max-width: 450px; 
        text-align: center; 
        border: 1px solid rgba(255,255,255,0.2); 
        box-sizing: border-box;">
        
        <!-- IT Branding Sign Board -->
        <div style="background: #1a1a1a; color: #f1c40f; padding: 6px 18px; border-radius: 5px; border: 1px double #f1c40f; font-family: 'Courier New', monospace; font-weight: bold; font-size: 10px; display: inline-block; margin-bottom: 25px; letter-spacing: 1px;">
            POWERED BY: SAHIL & ARMAN IT 💻
        </div>

        <!-- Header Icon -->
        <div style="background: #e67e22; width: 65px; height: 65px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 0 20px #e67e22;">
            <span style="color: white; font-size: 28px;">📝</span>
        </div>

        <h1 style="color: #fff; margin: 0; font-size: 32px; font-weight: 900; letter-spacing: 1px; text-transform: uppercase; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">
            Register
        </h1>
        <p style="color: #f1c40f; font-size: 16px; margin-top: 5px; margin-bottom: 35px; font-weight: 600;">
            Sindhi Marriage Bureau (رجسٽر ٿيو)
        </p>

        <form action="auth/register_process.php" method="POST">
            
            <!-- Full Name Input -->
            <div style="margin-bottom: 15px;">
                <input type="text" name="fullname" placeholder="Umeedwar ka Pura Naam" required 
                style="width: 100%; padding: 15px; border: none; border-radius: 12px; box-sizing: border-box; font-size: 16px; outline: none; background: rgba(255, 255, 255, 0.95); color: #222;">
            </div>

            <!-- Email Input -->
            <div style="margin-bottom: 15px;">
                <input type="email" name="email" placeholder="Email Address (اي ميل)" required 
                style="width: 100%; padding: 15px; border: none; border-radius: 12px; box-sizing: border-box; font-size: 16px; outline: none; background: rgba(255, 255, 255, 0.95); color: #222;">
            </div>
            
            <!-- Password Input with Toggle ID -->
            <div style="margin-bottom: 10px;">
                <input type="password" id="myPass" name="password" placeholder="Password (پاسورڊ)" required 
                style="width: 100%; padding: 15px; border: none; border-radius: 12px; box-sizing: border-box; font-size: 16px; outline: none; background: rgba(255, 255, 255, 0.95); color: #222;">
            </div>

            <!-- Show Password Checkbox -->
            <div style="text-align: left; margin-bottom: 25px; display: flex; align-items: center; gap: 8px; padding-left: 5px;">
                <input type="checkbox" id="toggleCheck" onclick="togglePass()" style="cursor: pointer; width: 16px; height: 16px; accent-color: #e67e22;"> 
                <label for="toggleCheck" style="font-size: 14px; color: #fff; cursor: pointer; user-select: none;">Show Password (پاسورڊ ڏسو)</label>
            </div>

            <!-- Action Button -->
            <button type="submit" style="width: 100%; padding: 18px; background: linear-gradient(to right, #e67e22, #d35400); color: white; border: none; border-radius: 15px; font-size: 20px; font-weight: bold; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(230, 126, 34, 0.4); text-transform: uppercase;">
                AGAY BARHO (اڳتي وڌو) →
            </button>
        </form>

        <!-- Footer Link -->
        <div style="margin-top: 25px;">
            <p style="color: rgba(255,255,255,0.7); font-size: 14px; margin: 0;">Pehle se account hai?</p>
            <a href="login.php" style="color: #fff; font-weight: bold; text-decoration: none; display: inline-block; margin-top: 10px; font-size: 16px; border-bottom: 2px solid #f1c40f;">
                Login Thiyo (داخل ٿيو)
            </a>
        </div>

    </div>
</div>

<!-- JavaScript for Password Toggle -->
<script>
function togglePass() {
    var x = document.getElementById("myPass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

<?php include('includes/footer.php'); ?>