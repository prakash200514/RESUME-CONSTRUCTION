<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please enter both email and password.";
        header("Location: auth.php");
        exit();
    }

    try {
        // Fetch user
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Success: Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect to dashboard (or home for now)
            header("Location: index.html"); 
            exit();
        } else {
            // Failure
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: auth.php");
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "Login failed. Please try again.";
        header("Location: auth.php");
        exit();
    }
} else {
    header("Location: auth.php");
    exit();
}
?>
