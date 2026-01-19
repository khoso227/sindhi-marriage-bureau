<?php
// --- SARANG ALI'S AUTO CODE UPDATER ---
$directory = new RecursiveDirectoryIterator('.');
$iterator = new RecursiveIteratorIterator($directory);

echo "<h1>Updating Alerts...</h1>";

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() == 'php') {
        $filePath = $file->getPathname();
        
        // File ka sara content parhna
        $content = file_get_contents($filePath);

        // 1. Purana Alert dhoondna aur replace karna
        // pattern: echo "<script>alert('...'); window.location='...';</script>";
        $newContent = preg_replace(
            '/echo\s+"<script>alert\(\'(.*?)\'\); window\.location=\'(.*?)\';<\/script>";/i',
            "alertMe('info', 'Notice', '$1', '$2');",
            $content
        );

        // 2. Agar koi tabdeeli hui to save karna
        if ($content !== $newContent) {
            file_put_contents($filePath, $newContent);
            echo "✅ Updated: " . $filePath . "<br>";
        }
    }
}

echo "<h3>Saari Files Update Ho Gayi Hain! Ab aap is fixer.php ko delete kar sakte hain.</h3>";
?>