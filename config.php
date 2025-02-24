<?php
// $host = '127.0.0.1';
// $username = 'mohamed';
// $password = 'Mohamed@8112001';
// $database = 'test' ;

$host = "127.0.0.1"; // or "localhost"
$database = "test";
$username = "root"; // Ensure this is correct
$password = "Mohamed@8112001"; // Ensure this is correct



try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ الاتصال ناجح!";
} catch (PDOException $e) {
    echo "❌ فشل الاتصال: " . $e->getMessage();
}
?>