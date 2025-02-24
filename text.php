<?php
include_once('database.php');

try {
    $db = new Database();
    $pdo = $db->getPDO();
    echo "✅ الاتصال بقاعدة البيانات ناجح من داخل الكود الرئيسي!";
} catch (PDOException $e) {
    echo "❌ فشل الاتصال: " . $e->getMessage();
}
?>