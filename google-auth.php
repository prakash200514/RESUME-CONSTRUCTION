<?php
require_once 'config.php';
session_start();

if (!isset($_POST['credential'])) {
    header("Location: auth.php");
    exit();
}

$id_token = $_POST['credential'];

/**
 * Verify Google ID Token
 * Note: For production, using google-api-php-client is recommended.
 * This manual check uses Google's tokeninfo endpoint.
 */
$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
$response = @file_get_contents($url);

if ($response === FALSE) {
    $_SESSION['error'] = "Failed to connect to Google verification service.";
    header("Location: auth.php");
    exit();
}

$payload = json_decode($response, true);

if (!$payload || isset($payload['error'])) {
    $_SESSION['error'] = "Invalid Google account or session expired.";
    header("Location: auth.php");
    exit();
}

// Verify that the token was intended for our app
if ($payload['aud'] !== GOOGLE_CLIENT_ID) {
    $_SESSION['error'] = "Authentication mismatch. Please try again.";
    header("Location: auth.php");
    exit();
}

$google_id = $payload['sub'];
$email = $payload['email'];
$first_name = $payload['given_name'] ?? 'Google';
$last_name = $payload['family_name'] ?? 'User';

try {
    // 1. Try to find user by google_id
    $stmt = $pdo->prepare("SELECT * FROM users WHERE google_id = ?");
    $stmt->execute([$google_id]);
    $user = $stmt->fetch();

    if (!$user) {
        // 2. If not found by google_id, try finding by email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // 3. User exists with this email, link the Google ID
            $update = $pdo->prepare("UPDATE users SET google_id = ? WHERE id = ?");
            $update->execute([$google_id, $user['id']]);
        } else {
            // 4. New user, create account
            $insert = $pdo->prepare("INSERT INTO users (google_id, first_name, last_name, email) VALUES (?, ?, ?, ?)");
            $insert->execute([$google_id, $first_name, $last_name, $email]);
            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$pdo->lastInsertId()]);
            $user = $stmt->fetch();
        }
    }

    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
    $_SESSION['success'] = "Successfully signed in with Google!";

    // Redirect to home page
    header("Location: index.html");
    exit();

} catch (PDOException $e) {
    $_SESSION['error'] = "System error: " . $e->getMessage();
    header("Location: auth.php");
    exit();
}
?>
