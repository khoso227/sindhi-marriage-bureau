<?php 
include('includes/db.php'); include('includes/header.php'); 
$plan = $_GET['plan']; $price = $_GET['price'];
?>

<div style="max-width: 500px; margin: 40px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center;">
    <h2 style="color: #27ae60;">Final Step: Payment</h2>
    <p>Aap ne <b><?php echo $plan; ?> Plan</b> select kiya hai.</p>
    
    <div style="background: #fdf2e9; padding: 20px; border-radius: 10px; margin: 20px 0;">
        <p style="margin:0;">Hamare <b>EasyPaisa</b> par <b>Rs. <?php echo $price; ?></b> bhejein:</p>
        <h3 style="color: #e67e22; margin: 10px 0;">0300-1234567</h3>
        <p style="font-size: 12px; color: #666;">(Account Title: Sarang Ali)</p>
    </div>

    <form action="payment_submit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="plan" value="<?php echo $plan; ?>">
        <input type="hidden" name="amount" value="<?php echo $price; ?>">
        
        <label>Payment Screenshot Upload Karein:</label><br>
        <input type="file" name="ss" required style="margin: 15px 0;"><br>
        
        <button type="submit" name="submit_payment" style="width: 100%; padding: 12px; background: #2c3e50; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">SUBMIT FOR APPROVAL</button>
    </form>
</div><input type="text" name="tid" placeholder="Enter Transaction ID (TID)" required style="width: 100%; padding: 12px; margin-bottom: 10px; border-radius: 8px; border: 1px solid #ddd;">