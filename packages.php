<?php 
include('includes/db.php'); 
include('includes/header.php'); 

// Check if user is logged in for WhatsApp message
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'Guest User';
$whatsapp_num = "923033447261"; // Aap ka asli number
?>

<div style="background: #fdf2e9; min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif; padding: 40px 10px;">
    
    <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        
        <h1 style="color: #e67e22; font-size: 40px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px;">Membership & Recharge Plans 💎</h1>
        <p style="color: #555; font-size: 18px; margin-bottom: 40px;">Apne liye behtreen rishta talash karne ke liye sahi plan muntakhib karein.</p>

        <!-- SECTION 1: MAIN MEMBERSHIP PLANS -->
        <h2 style="color: #2c3e50; border-left: 5px solid #e67e22; padding-left: 15px; display: inline-block; margin-bottom: 30px;">1. VIP Membership Plans</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 60px;">
            
            <!-- FREE PLAN -->
            <div style="background: #fff; padding: 30px; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid #ddd;">
                <h3 style="color: #7f8c8d;">FREE</h3>
                <h2 style="font-size: 32px; color: #2c3e50;">Rs. 0</h2>
                <ul style="text-align: left; font-size: 14px; color: #666; line-height: 2.5; list-style: none; padding: 0;">
                    <li>✅ View Profiles</li>
                    <li>✅ Basic Search</li>
                    <li>❌ Cannot Send Requests</li>
                    <li>❌ No WhatsApp Access</li>
                </ul>
                <button disabled style="width:100%; padding:12px; background:#eee; border:none; border-radius:10px; margin-top: 20px;">Current Plan</button>
            </div>

            <!-- GOLD PLAN (MOST POPULAR) -->
            <div style="background: #fff; padding: 30px; border-radius: 20px; border: 3px solid #e67e22; transform: scale(1.05); box-shadow: 0 15px 35px rgba(230,126,34,0.2); position: relative;">
                <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: #e67e22; color: #fff; font-size: 12px; padding: 5px 20px; border-radius: 20px; font-weight: bold;">LIFETIME ACCESS</div>
                <h3 style="color: #e67e22;">GOLD MEMBER</h3>
                <h2 style="font-size: 32px; color: #e67e22;">Rs. 1,500</h2>
                <ul style="text-align: left; font-size: 14px; color: #333; line-height: 2.5; list-style: none; padding: 0;">
                    <li>✅ <b>Unlimited</b> Match Requests</li>
                    <li>✅ Direct <b>WhatsApp</b> Numbers</li>
                    <li>✅ Profile Highlighting</li>
                    <li>✅ Verification Badge 🛡️</li>
                </ul>
                <a href="#pay" style="display:block; padding:12px; background:#e67e22; color:#fff; text-decoration:none; border-radius:10px; margin-top: 20px; font-weight:bold;">BUY GOLD</a>
            </div>

            <!-- DIAMOND PLAN -->
            <div style="background: #2c3e50; padding: 30px; border-radius: 20px; color: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                <h3 style="color: #f1c40f;">DIAMOND</h3>
                <h2 style="font-size: 32px; color: #f1c40f;">Rs. 10,000</h2>
                <ul style="text-align: left; font-size: 14px; color: #bdc3c7; line-height: 2.5; list-style: none; padding: 0;">
                    <li>✅ 50 Special Requests</li>
                    <li>✅ Dedicated Manager</li>
                    <li>✅ Personal Matchmaking</li>
                    <li>✅ Direct Contact Sharing</li>
                </ul>
                <a href="#pay" style="display:block; padding:12px; background:#f1c40f; color:#000; text-decoration:none; border-radius:10px; margin-top: 20px; font-weight:bold;">GET DIAMOND</a>
            </div>

        </div>

        <!-- SECTION 2: RECHARGE TOKEN PACKS -->
        <h2 style="color: #2c3e50; border-left: 5px solid #3498db; padding-left: 15px; display: inline-block; margin-bottom: 30px;">2. Request Recharge Packs</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 60px;">
            
            <!-- Registration Tax -->
            <div style="background: #fff; padding: 20px; border-radius: 15px; border-top: 5px solid #e74c3c; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <h4 style="margin: 0; color: #e74c3c;">Starter Tax</h4>
                <h2 style="margin: 10px 0;">Rs. 500</h2>
                <p style="font-size: 12px; color: #777;">(Unlock 3rd Request)</p>
                <a href="#pay" style="display:block; padding:8px; background:#e74c3c; color:#fff; text-decoration:none; border-radius:5px; font-size: 13px;">PAY TAX</a>
            </div>

            <!-- Basic -->
            <div style="background: #fff; padding: 20px; border-radius: 15px; border-top: 5px solid #3498db; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <h4 style="margin: 0; color: #3498db;">Basic Pack</h4>
                <h2 style="margin: 10px 0;">Rs. 1,000</h2>
                <p style="font-size: 12px; color: #777;">(3 Naye Rishtay)</p>
                <a href="#pay" style="display:block; padding:8px; background:#3498db; color:#fff; text-decoration:none; border-radius:5px; font-size: 13px;">ACTIVATE</a>
            </div>

            <!-- Standard -->
            <div style="background: #fff; padding: 20px; border-radius: 15px; border-top: 5px solid #2ecc71; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <h4 style="margin: 0; color: #2ecc71;">Standard Pack</h4>
                <h2 style="margin: 10px 0;">Rs. 2,000</h2>
                <p style="font-size: 12px; color: #777;">(5 Naye Rishtay)</p>
                <a href="#pay" style="display:block; padding:8px; background:#2ecc71; color:#fff; text-decoration:none; border-radius:5px; font-size: 13px;">ACTIVATE</a>
            </div>

            <!-- Premium -->
            <div style="background: #fff; padding: 20px; border-radius: 15px; border-top: 5px solid #9b59b6; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <h4 style="margin: 0; color: #9b59b6;">Premium Pack</h4>
                <h2 style="margin: 10px 0;">Rs. 4,000</h2>
                <p style="font-size: 12px; color: #777;">(10 Naye Rishtay)</p>
                <a href="#pay" style="display:block; padding:8px; background:#9b59b6; color:#fff; text-decoration:none; border-radius:5px; font-size: 13px;">ACTIVATE</a>
            </div>

        </div>

        <!-- SECTION 3: PAYMENT METHOD -->
        <div id="pay" style="max-width: 800px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 30px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); border: 1px solid #eee;">
            <h2 style="color: #2c3e50;">Payment Ka Tareeqa 💳</h2>
            <p>Apna pasandida plan select karein aur neechay diye gaye account par raqam bhejein.</p>

            <div style="background: #fdf2e9; padding: 30px; border-radius: 20px; border: 2px dashed #e67e22; margin: 30px 0;">
                <h3 style="margin: 0; color: #2c3e50; text-transform: uppercase; letter-spacing: 1px;">EasyPaisa / JazzCash</h3>
                <h1 style="color: #e67e22; margin: 15px 0; font-size: 45px;">0303-3447261</h1>
                <p style="font-weight: bold; margin: 0; font-size: 20px; color: #333;">Account Name: Sarang Ali</p>
            </div>

            <div style="background: #eafaf1; padding: 20px; border-radius: 15px; margin-bottom: 30px; border: 1px solid #27ae60;">
                <p style="margin: 0; color: #27ae60; font-weight: bold;">
                    📢 Paisa bhejney ke baad, screenshot hamare WhatsApp par bhejein taake aap ka account foran upgrade kiya ja sakay.
                </p>
            </div>

            <!-- WhatsApp Button -->
            <a href="https://wa.me/<?php echo $whatsapp_num; ?>?text=Assalam-o-Alaikum, Maine SMB Portal par payment kar di hai. Meharbani karke mera account upgrade kardein. My Email: <?php echo $user_email; ?>" 
               target="_blank"
               style="display: inline-block; background: #27ae60; color: white; padding: 20px 45px; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 20px; box-shadow: 0 10px 25px rgba(39,174,96,0.3); transition: 0.3s;">
               SEND SCREENSHOT ON WHATSAPP ✅
            </a>
        </div>

    </div>

</div>

<?php include('includes/footer.php'); ?>