<?php
require_once 'config.php';

try {
    $pdo->exec("ALTER TABLE users ADD COLUMN google_id VARCHAR(255) AFTER id");
    $pdo->exec("ALTER TABLE users MODIFY password VARCHAR(255) DEFAULT NULL");
    echo "Database updated successfully!";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), "Duplicate column name") !== false) {
        echo "Database already updated.";
    } else {
        echo "Error updating database: " . $e->getMessage();
    }
}
?>
