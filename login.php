<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include('includes/header.php'); 
?>

<!-- 1. SweetAlert2 Library Include -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Your Provided Bridal Background -->
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; 
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
    url('images/bride_final.jpg') no-repeat center center fixed; 
    background-size: cover; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif; margin-top: -2px;">

    <!-- Premium Glassmorphism Card -->
    <div style="background: rgba(255, 255, 255, 0.1); 
        backdrop-filter: blur(15px); 
        -webkit-backdrop-filter: blur(15px);
        padding: 50px 35px; 
        border-radius: 35px; 
        box-shadow: 0 30px 60px rgba(0,0,0,0.7); 
        width: 100%; 
        max-width: 420px; 
        text-align: center; 
        border: 1px solid rgba(255,255,255,0.2); 
        box-sizing: border-box;">
        
        <!-- IT Branding Badge -->
        <div style="background: #1a1a1a; color: #f1c40f; padding: 6px 18px; border-radius: 30px; border: 1px solid #f1c40f; font-family: 'Courier New', monospace; font-weight: bold; font-size: 10px; display: inline-block; margin-bottom: 25px; letter-spacing: 2px;">
            SAHIL & ARMAN IT SYSTEMS 🛡️
        </div>

        <div style="margin-bottom: 20px;">
            <h1 style="color: #fff; margin: 0; font-size: 36px; font-weight: 900; letter-spacing: 2px; text-transform: uppercase; text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
                Login
            </h1>
            <p style="color: #f1c40f; font-size: 15px; margin-top: 5px; margin-bottom: 35px; font-weight: 600;">
                Sindhi Marriage Bureau (داخل ٿيو)
            </p>
        </div>

        <form action="auth/login_process.php" method="POST">
            
            <div style="text-align: left; margin-bottom: 20px;">
                <input type="email" name="email" placeholder="Email Address (اي ميل)" required 
                style="width: 100%; padding: 16px; border: none; border-radius: 15px; box-sizing: border-box; font-size: 16px; outline: none; background: rgba(255, 255, 255, 0.95); color: #222;">
            </div>
            
            <div style="text-align: left; margin-bottom: 10px;">
                <input type="password" id="myPass" name="password" placeholder="Password (پاسورڊ)" required 
                style="width: 100%; padding: 16px; border: none; border-radius: 15px; box-sizing: border-box; font-size: 16px; outline: none; background: rgba(255, 255, 255, 0.95); color: #222;">
            </div>

            <div style="text-align: left; margin-bottom: 30px; display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" id="toggleCheck" onclick="togglePass()" style="cursor: pointer; width: 18px; height: 18px;"> 
                <label for="toggleCheck" style="font-size: 14px; color: #fff; cursor: pointer; user-select: none;">Show Password</label>
            </div>

            <button type="submit" style="width: 100%; padding: 18px; background: linear-gradient(135deg, #800000, #b00000); color: white; border: none; border-radius: 15px; font-size: 18px; font-weight: bold; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.4); text-transform: uppercase;">
                Proceed to Dashboard
            </button>
        </form>

        <div style="margin-top: 25px;">
            <a href="forgot_password.php" style="color: #f1c40f; text-decoration: none; font-size: 13px; font-weight: bold;">
                Forgot Password? 🔑
            </a>
        </div>

        <div style="margin-top: 35px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
            <a href="register.php" style="color: #fff; font-weight: bold; text-decoration: none; display: inline-block; font-size: 16px; border-bottom: 2px solid #f1c40f;">
                Create Free Account (رجسٽر ٿيو)
            </a>
        </div>

    </div>
</div>

<script>
// Password toggle function
function togglePass() {
    var x = document.getElementById("myPass");
    if (x.type === "password") { x.type = "text"; } else { x.type = "password"; }
}

// 2. SweetAlert Trigger Logic
// Ye script check karegi ke kya URL mein koi message hai
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('error')) {
    Swal.fire({
        icon: 'error',
        title: 'Oho!',
        text: 'Email ya Password ghalat hai.',
        confirmButtonColor: '#b00000',
        background: '#fff'
    });
}
if (urlParams.has('success')) {
    Swal.fire({
        icon: 'success',
        title: 'Mubarak!',
        text: 'Aap ka kaam ho gaya hai.',
        confirmButtonColor: '#27ae60'
    });
}
</script>

<?php include('includes/footer.php'); ?>