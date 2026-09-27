<?php 
require_once 'config.php';
session_start(); 

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join AuraCV | Student Resume Builder</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Google Identity Services -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css?v=4">

    <style>
        .auth-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2.25rem;
            box-shadow: var(--shadow-lg);
        }
        .alert {
            padding: 0.85rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
            text-align: center;
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }
        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
        }
        .auth-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
            background-color: var(--bg-soft);
        }
        .auth-container {
            width: 100%;
            max-width: 450px;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 1.75rem;
        }
        .auth-header .logo {
            justify-content: center;
        }
        .auth-tabs {
            display: flex;
            background: #f1f5f9;
            border-radius: 10px;
            padding: 4px;
            margin-bottom: 1.5rem;
            position: relative;
        }
        .tab-btn {
            flex: 1;
            padding: 0.6rem;
            border: none;
            background: none;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-muted);
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .tab-btn.active {
            background: #ffffff;
            color: var(--navy);
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        .auth-form {
            display: none;
        }
        .auth-form.active {
            display: block;
        }
        .form-group {
            margin-bottom: 1.15rem;
        }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0.35rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(24, 90, 219, 0.12);
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.25rem;
        }
        .divider {
            text-align: center;
            position: relative;
            margin: 1.5rem 0;
        }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background: var(--border);
        }
        .divider span {
            background: #ffffff;
            padding: 0 0.75rem;
            position: relative;
            font-size: 0.82rem;
            color: var(--text-light);
        }
    </style>
</head>
<body class="auth-page">

    <div class="auth-container">
        <div class="auth-header">
            <a href="index.php" class="logo">
                <span class="logo-badge"></span>
                <span>aura</span>cv
            </a>
            <p style="margin-top: 0.5rem; font-size: 0.9rem; color: var(--text-muted); font-weight: 500;">
                &#127891; Build your student resume for free
            </p>
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
            </div>

            <!-- Login Form -->
            <form id="login-form" class="auth-form active" action="login.php" method="POST">
                <div class="form-group">
                    <label for="login-email">Email Address</label>
                    <input type="email" id="login-email" name="email" placeholder="student@college.edu" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-options">
                    <label style="display:flex; align-items:center; gap:0.4rem; cursor:pointer;">
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#" style="color:var(--blue); font-weight:600;">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-blue btn-full" style="padding:0.75rem;">Sign In</button>
                
                <div class="divider"><span>Or continue with</span></div>
                
                <div class="social-login">
                    <div class="google-login-container" style="width: 100%;"></div>
                </div>
            </form>

            <!-- Register Form -->
            <form id="register-form" class="auth-form" action="register.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="reg-first">First Name</label>
                        <input type="text" id="reg-first" name="first_name" placeholder="Saanvi" required>
                    </div>
                    <div class="form-group">
                        <label for="reg-last">Last Name</label>
                        <input type="text" id="reg-last" name="last_name" placeholder="Patel" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reg-email">Email Address</label>
                    <input type="email" id="reg-email" name="email" placeholder="student@college.edu" required>
                </div>
                <div class="form-group">
                    <label for="reg-password">Password</label>
                    <input type="password" id="reg-password" name="password" placeholder="Min. 8 characters" required>
                </div>
                <p style="font-size:0.78rem; color:var(--text-light); text-align:center; margin-bottom:1rem;">
                    By signing up, you agree to our <a href="#" style="color:var(--blue);">Terms</a> and <a href="#" style="color:var(--blue);">Privacy Policy</a>.
                </p>
                <button type="submit" class="btn btn-amber btn-full" style="padding:0.75rem;">Create Free Account</button>
                
                <div class="divider"><span>Or continue with</span></div>
                
                <div class="social-login">
                    <div class="google-login-container" style="width: 100%;"></div>
                </div>
            </form>
        </div>
        
        <div style="text-align:center; margin-top:1.5rem;">
            <p><a href="index.php" style="color:var(--text-muted); font-size:0.9rem; font-weight:600;">&larr; Back to home</a></p>
        </div>
    </div>

    <script>
        const loginTab = document.getElementById('login-tab');
        const registerTab = document.getElementById('register-tab');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');

        loginTab.addEventListener('click', () => {
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
            loginForm.classList.add('active');
            registerForm.classList.remove('active');
        });

        registerTab.addEventListener('click', () => {
            registerTab.classList.add('active');
            loginTab.classList.remove('active');
            registerForm.classList.add('active');
            loginForm.classList.remove('active');
        });

        if (window.location.hash === '#register') {
            registerTab.click();
        }

        // Google Identity Services Initialization
        function handleCredentialResponse(response) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'google-auth.php';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'credential';
            input.value = response.credential;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        window.onload = function () {
            if (typeof google !== 'undefined') {
                google.accounts.id.initialize({
                    client_id: "<?php echo GOOGLE_CLIENT_ID; ?>",
                    callback: handleCredentialResponse
                });
                
                const containers = document.querySelectorAll('.google-login-container');
                containers.forEach(container => {
                    google.accounts.id.renderButton(
                        container,
                        { 
                            theme: "outline", 
                            size: "large", 
                            width: container.offsetWidth || 370, 
                            text: "continue_with",
                            shape: "rectangular",
                            logo_alignment: "center"
                        }
                    );
                });
                
                google.accounts.id.prompt(); 
            }
        };
    </script>
</body>
</html>
