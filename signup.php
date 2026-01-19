<?php include('includes/header.php'); ?>

<div style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/Sindh pic.jpg') no-repeat center center fixed; background-size: cover; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', Arial, sans-serif;">
    
    <div style="max-width: 400px; width: 90%; background: rgba(255, 255, 255, 0.98); padding: 40px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.5); text-align: center;">
        
        <h2 style="color: #e67e22; margin-bottom: 10px;">SIGN UP (اکائونٽ ٺاهيو)</h2>
        <p style="color: #666; font-size: 14px; margin-bottom: 30px;">Pehle apna account shuru karein.</p>

        <form action="auth/signup_process.php" method="POST">
            <input type="email" name="email" placeholder="Email Address (اي ميل)" required style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px;">
            
            <input type="password" name="password" placeholder="Password (پاسورڊ)" required style="width: 100%; padding: 12px; margin-bottom: 25px; border: 1px solid #ddd; border-radius: 8px;">
            
            <button type="submit" style="width: 100%; padding: 15px; background: #e67e22; color: white; border: none; border-radius: 12px; font-weight: bold; font-size: 18px; cursor: pointer;">
                AGAY BARHO (اڳتي وڌو) →
            </button>
        </form>
        
        <p style="margin-top: 20px; font-size: 14px;">Pehle se account hai? <a href="login.php" style="color: #e67e22; font-weight: bold; text-decoration: none;">Login Thiyo</a></p>
    </div>
</div>

<?php include('includes/footer.php'); ?>