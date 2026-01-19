<?php
// Chat file ki permission zabardasti 644 kar rahe hain
if (chmod("chat.php", 0644)) {
    echo "<h1>Mubarak ho! chat.php ki permission theek ho gayi hai.</h1>";
} else {
    echo "<h1>Maafi chahte hain, permission tabdil nahi ho saki.</h1>";
}

// Poore htdocs folder ko check karne ke liye
echo "Current folder permissions: " . substr(sprintf('%o', fileperms('.')), -4);
?>