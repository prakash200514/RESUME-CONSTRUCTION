<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join AuraCV | Experience Premium Resume Building</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    
    <style>
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            text-align: center;
            animation: fadeIn 0.4s ease;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #4ade80;
        }
    </style>
</head>
<body class="auth-page">
    <div class="bg-mesh"></div>

    <div class="auth-container">
        <div class="auth-header">
            <a href="index.html" class="logo">
                <span class="logo-icon"></span>
                <span class="logo-text">Aura<span>CV</span></span>
            </a>
        </div>

        <div class="auth-card">
            <!-- Alert Messages -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <!-- Tabs -->
            <div class="auth-tabs">
                <button class="tab-btn active" id="login-tab">Login</button>
                <button class="tab-btn" id="register-tab">Register</button>
                <div class="tab-indicator"></div>
            </div>

            <!-- Login Form -->
            <form id="login-form" class="auth-form active" action="login.php" method="POST">
                <div class="form-group">
                    <label for="login-email">Email Address</label>
                    <input type="email" id="login-email" name="email" placeholder="name@company.com" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Sign In</button>
                
                <div class="divider"><span>Or continue with</span></div>
                
                <div class="social-login">
                    <button type="button" class="btn btn-outline btn-full">
                        <img src="https://www.google.com/favicon.ico" alt="Google" width="16"> Google
                    </button>
                </div>
            </form>

            <!-- Register Form -->
            <form id="register-form" class="auth-form" action="register.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="reg-first">First Name</label>
                        <input type="text" id="reg-first" name="first_name" placeholder="John" required>
                    </div>
                    <div class="form-group">
                        <label for="reg-last">Last Name</label>
                        <input type="text" id="reg-last" name="last_name" placeholder="Doe" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reg-email">Email Address</label>
                    <input type="email" id="reg-email" name="email" placeholder="name@company.com" required>
                </div>
                <div class="form-group">
                    <label for="reg-password">Password</label>
                    <input type="password" id="reg-password" name="password" placeholder="Min. 8 characters" required>
                </div>
                <p class="terms-text">By signing up, you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.</p>
                <button type="submit" class="btn btn-primary btn-full">Create Account</button>
                
                <div class="divider"><span>Or continue with</span></div>
                
                <div class="social-login">
                    <button type="button" class="btn btn-outline btn-full">
                        <img src="https://www.google.com/favicon.ico" alt="Google" width="16"> Google
                    </button>
                </div>
            </form>
        </div>
        
        <div class="auth-footer">
            <p><a href="index.html">← Back to home</a></p>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        // Check URL hash for tab activation
        if (window.location.hash === '#register') {
            document.getElementById('register-tab').click();
        }
    </script>
</body>
</html>
