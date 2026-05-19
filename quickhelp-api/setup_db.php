<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = file_get_contents('../config/bd.sql');
    
    // Some PDO drivers don't support multi-query execution well, but let's try.
    // If it fails, we can split by semicolon.
    $pdo->exec($sql);
    
    echo "Database created and seeded successfully.\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
