<?php
// Database Configuration
$host = 'localhost';
$dbname = 'auracv_db';
$username = 'root';
$password = 'password';

// Google Auth Configuration
define('GOOGLE_CLIENT_ID', '751857537261-7ts0fif2gda7tvcn9bi76c720su3pdj8.apps.googleusercontent.com');

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // In production, don't show the full error
    die("Connection failed: " . $e->getMessage());
}
?>
