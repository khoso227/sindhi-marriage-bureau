<?php 
include('includes/db.php');
include('includes/header.php'); 

// Security Check: Login check
if(!isset($_SESSION['user_id'])) { 
    echo "<script>window.location='register.php';</script>"; 
    exit(); 
}
?>

<style>
    /* HD AI Bridal Background */
    .main-bg {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                    url('https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=1974&auto=format&fit=crop'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        padding: 50px 10px;
        display: flex;
        align-items: center;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    .glass-form {
        max-width: 950px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.98); 
        padding: 40px;
        border-radius: 30px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        border-top: 10px solid #e67e22;
    }

    /* Mobile Responsive Grid Fix */
    .responsive-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .section-head {
        background: #2c3e50;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: bold;
        font-size: 18px;
    }

    input, select {
        width: 100%;
        padding: 14px;
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-top: 8px;
        box-sizing: border-box; /* Mobile width fix */
        font-size: 15px;
    }

    label { font-weight: 600; color: #444; font-size: 14px; }

    @media (max-width: 600px) {
        .glass-form { padding: 20px; }
        .section-head { font-size: 16px; padding: 10px; }
    }
</style>

<div class="main-bg">
    <div class="glass-form">
        
        <!-- 📢 Sakht Hidayat Notice Board -->
        <div style="background: #fff5f5; border: 2px solid #c0392b; padding: 20px; border-radius: 15px; margin-bottom: 35px; text-align: left;">
            <h3 style="color: #c0392b; margin-top: 0;">⚠️ SAKHT HIDAYAT (IMPORTANT)</h3>
            <ul style="color: #333; font-size: 14px; line-height: 1.6; padding-left: 20px;">
                <li>Poori malomat dena lazmi hai. Khali form hargiz accept nahi kiya jayega.</li>
                <li><b>CNIC</b> aur <b>WhatsApp</b> number sahi likhein, warna admin block kar dega.</li>
            </ul>
        </div>

        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="color: #e67e22; margin: 0; font-size: 32px; font-weight: 800;">SINDHI MARRIAGE BUREAU</h1>
            <h2 style="color: #2c3e50; font-size: 20px; margin-top: 5px;">MUKAMMAL PROFILE (پروفائل مڪمل ڪريو)</h2>
        </div>

        <form action="auth/finish_profile.php" method="POST">
            
            <!-- SECTION 1: GUARDIAN -->
            <div class="section-head" style="background: #e67e22;">1. Sarparast (Guardian) Details</div>
            <div class="responsive-grid">
                <div>
                    <label>Sarparast ka Naam:</label>
                    <input type="text" name="guardian_name" placeholder="Father/Guardian Name" required>
                </div>
                <div>
                    <label>Umeedwar se Rishta:</label>
                    <select name="relation" required>
                        <option value="Walid">Walid (Father) / پيءُ</option>
                        <option value="Walida">Walida (Mother) / ماءُ</option>
                        <option value="Self">Self (پاڻ)</option>
                        <option value="Aziz">Aziz (Relative) / مائٽ</option>
                    </select>
                </div>
                <div>
                    <label>Sarparast Mobile No:</label>
                    <input type="text" name="guardian_phone" placeholder="03xxxxxxxxx" required>
                </div>
            </div>

            <!-- SECTION 2: CANDIDATE -->
            <div class="section-head">2. Umeedwar ki Malomat (Candidate)</div>
            <div class="responsive-grid">
                <div>
                    <label>Jins (Gender):</label>
                    <select name="gender" required>
                        <option value="Mard">Mard / گھوٽ</option>
                        <option value="Khatoon">Khatoon / ڪنوار</option>
                    </select>
                </div>
                <div>
                    <label>Umar (Age):</label>
                    <input type="number" name="age" min="18" placeholder="Enter Age" required>
                </div>
                <div>
                    <label>Umeedwar WhatsApp No:</label>
                    <input type="text" name="phone" placeholder="03xxxxxxxxx" required>
                </div>
                <div>
                    <label>Candidate CNIC:</label>
                    <input type="text" name="cnic" placeholder="42xxx-xxxxxxx-x" required>
                </div>
                <div>
                    <label>Marital Status:</label>
                    <select name="marital_status" required>
                        <option value="Single">Single / ڪنوارو</option>
                        <option value="Divorced">Divorced / طلاق يافته</option>
                        <option value="Widowed">Widowed / بيواهه</option>
                    </select>
                </div>
            </div>

            <!-- SECTION 3: LOCATION (Responsive Grid) -->
            <div class="section-head" style="background: #34495e;">3. Rehaish / Location (رهائش جي معلومات)</div>
            <div class="responsive-grid">
                <div>
                    <label>Division:</label>
                    <input type="text" name="division" placeholder="Division / ڊويزن" required>
                </div>
                <div>
                    <label>District:</label>
                    <input type="text" name="district" placeholder="District / ضلعو" required>
                </div>
                <div>
                    <label>Tehsil:</label>
                    <input type="text" name="tehsil" placeholder="Tehsil / تحصيل" required>
                </div>
            </div>

            <!-- SECTION 4: BACKGROUND -->
            <div class="responsive-grid">
                <div>
                    <label>Mazhab (Religion):</label>
                    <input type="text" name="religion" placeholder="Muslim, Hindu..." required>
                </div>
                <div>
                    <label>Zat (Caste):</label>
                    <input type="text" name="caste" placeholder="Zat Likhein" required>
                </div>
                <div>
                    <label>Rozgaar (Occupation):</label>
                    <input type="text" name="occupation" placeholder="Job or Business" required>
                </div>
            </div>

            <button type="submit" style="width: 100%; padding: 22px; background: linear-gradient(to right, #e67e22, #d35400); color: white; border: none; border-radius: 15px; font-size: 22px; font-weight: bold; cursor: pointer; box-shadow: 0 10px 25px rgba(230,126,34,0.4); text-transform: uppercase;">
                SUBMIT & ACTIVATE PROFILE →
            </button>
        </form>
    </div>
</div>

<!-- FOOTER BILKUL AAKHIR MEIN - SAHIL & ARMAN LOGO NEECHE AAYEGA -->
<?php include('includes/footer.php'); ?>