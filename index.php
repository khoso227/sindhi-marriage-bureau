<?php 
include('includes/db.php');
include('includes/header.php'); 
?>

<!-- 1. HERO SECTION: AI Style Cinematic Banner -->
<div style="background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), 
            url('https://images.unsplash.com/photo-1621112904887-419379ce6824?q=80&w=2070&auto=format&fit=crop') no-repeat center center fixed; 
            background-size: cover; 
            min-height: 90vh; 
            display: flex; 
            flex-direction: column;
            align-items: center; 
            justify-content: center; 
            text-align: center; 
            color: white;
            padding: 20px;
            margin-top: -2px;
            border-bottom: 8px solid #e67e22;">

    <!-- Sahil & Arman IT Sign Board -->
    <div style="background: #1a1a1a; color: #f1c40f; padding: 12px 30px; border-radius: 8px; border: 2px double #f1c40f; font-family: 'Courier New', monospace; font-weight: bold; margin-bottom: 35px; box-shadow: 0 0 25px rgba(241, 196, 15, 0.4); text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">
        Sahil & Arman IT Companies Product 💻
    </div>

    <!-- Main Headings -->
    <h1 style="font-size: clamp(38px, 9vw, 70px); margin: 0; text-transform: uppercase; letter-spacing: 4px; font-weight: 900; text-shadow: 0 10px 20px rgba(0,0,0,0.9);">
        Sindhi Marriage Bureau
    </h1>
    
    <div style="margin-top: 20px;">
        <h3 style="color: #f1c40f; margin: 0; font-size: 26px; font-weight: 600; letter-spacing: 1px;">Sacho Rishto, Sachi Pehchan</h3>
        <h2 style="color: #f1c40f; margin-top: 12px; font-size: 32px; font-family: 'Times New Roman';">
            (سچو رشتو، سچي پڃاڻ)
        </h2>
    </div>

    <!-- Dynamic Call to Action Button -->
    <div style="margin-top: 50px;">
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="register.php" style="background: linear-gradient(to right, #e67e22, #d35400); color: white; padding: 20px 50px; text-decoration: none; border-radius: 60px; font-weight: bold; font-size: 22px; box-shadow: 0 10px 30px rgba(230,126,34,0.5); transition: 0.3s; display: inline-block; text-transform: uppercase;">
                Register Now (Free)
            </a>
        <?php else: ?>
            <a href="dashboard.php" style="background: linear-gradient(to right, #2ecc71, #27ae60); color: white; padding: 20px 50px; text-decoration: none; border-radius: 60px; font-weight: bold; font-size: 22px; box-shadow: 0 10px 30px rgba(46,204,113,0.4); display: inline-block; text-transform: uppercase;">
                Go to Dashboard
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- 2. QUICK STATS BAR -->
<div style="background: #2c3e50; padding: 50px 20px; color: white; text-align: center; border-bottom: 2px solid #f1c40f;">
    <div style="display: flex; justify-content: center; gap: 80px; flex-wrap: wrap; max-width: 1100px; margin: 0 auto;">
        <div>
            <h2 style="color: #f1c40f; margin:0; font-size: 45px; font-weight: 800;">500+</h2>
            <p style="margin:5px 0; opacity: 0.8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px;">Verified Profiles</p>
        </div>
        <div>
            <h2 style="color: #f1c40f; margin:0; font-size: 45px; font-weight: 800;">100+</h2>
            <p style="margin:5px 0; opacity: 0.8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px;">Success Matches</p>
        </div>
        <div>
            <h2 style="color: #f1c40f; margin:0; font-size: 45px; font-weight: 800;">100%</h2>
            <p style="margin:5px 0; opacity: 0.8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px;">Privacy Secured</p>
        </div>
    </div>
</div>

<!-- 3. SUCCESS STORIES SECTION -->
<div style="padding: 100px 20px; background: #fffcf9; text-align: center;">
    <h2 style="color: #2c3e50; font-size: 40px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">
        Kamyab Rishte <span style="color: #e67e22;">(Success Stories)</span>
    </h2>
    <div style="height: 5px; width: 100px; background: #e67e22; margin: 15px auto 60px; border-radius: 10px;"></div>
    
    <!-- Premium Success Story Card -->
    <div style="max-width: 580px; margin: 0 auto; background: white; padding: 35px; border-radius: 40px; box-shadow: 0 25px 60px rgba(0,0,0,0.08); border: 1px solid #fdf2e9; text-align: center; transition: 0.3s;">
        
        <div style="overflow: hidden; border-radius: 25px; height: 500px; margin-bottom: 30px; border: 6px solid #fdf2e9; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <!-- Aap ki bheji hui asli couple photo -->
            <img src="images/couple_success.jpg" 
                 style="width: 100%; height: 125%; object-fit: cover;" 
                 alt="Sindhi Successful Couple">
        </div>
        
        <h3 style="color: #e67e22; margin: 0; font-size: 32px; font-weight: 800;">Ali & Dua</h3>
        <p style="color: #999; font-size: 14px; font-weight: bold; text-transform: uppercase; margin-top: 8px; letter-spacing: 1px;">Mubarak Rishto (2024)</p>
        
        <p style="font-style: italic; color: #444; line-height: 2; font-size: 18px; margin-top: 25px; position: relative; padding: 0 20px;">
            <span style="font-size: 60px; color: #e67e22; opacity: 0.2; position: absolute; left: -15px; top: -35px; font-family: serif;">“</span>
            SMB ki wajah se humein hamara behtreen sathi mila. Sahil & Arman IT Companies ne aik bohot hi haseen aur mehfooz platform banaya hai. Dil se shukriya!
            <span style="font-size: 60px; color: #e67e22; opacity: 0.2; position: absolute; right: -15px; bottom: -55px; font-family: serif;">”</span>
        </p>
    </div>
</div>

<?php include('includes/footer.php'); ?><div id="live-toast" style="position: fixed; bottom: 20px; left: 20px; background: rgba(26,26,26,0.9); color: #fff; padding: 12px 20px; border-radius: 8px; font-size: 12px; border-left: 4px solid #f1c40f; display: none; z-index: 9999; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
    🚀 <span id="toast-msg">Naya Rishta Register Hua: Karachi se</span>
</div>

<script>
    const messages = [
        "Naya umeedwar register hua: Hyderabad",
        "3 logon ne aaj match talash kiya",
        "Saeed ne naya rishta request bheja",
        "Verified Member Joined: Sukkur",
        "Sahil & Arman IT Security: System Secure"
    ];

    function showToast() {
        const toast = document.getElementById('live-toast');
        const msg = document.getElementById('toast-msg');
        msg.innerText = messages[Math.floor(Math.random() * messages.length)];
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 4000);
    }

    setInterval(showToast, 15000); // Har 15 second baad dikhaye
</script>