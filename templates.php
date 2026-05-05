<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Template | AuraCV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .templates-hero {
            padding-top: calc(var(--nav-height) + 4rem);
            padding-bottom: 4rem;
            text-align: center;
        }
        .templates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 3rem;
            padding-bottom: 8rem;
        }
        .template-card {
            background: var(--surface);
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .template-card:hover {
            transform: translateY(-12px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }
        .template-preview {
            width: 100%;
            height: 450px;
            overflow: hidden;
            position: relative;
        }
        .template-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .template-card:hover .template-preview img {
            transform: scale(1.05);
        }
        .template-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 10, 11, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .template-card:hover .template-overlay {
            opacity: 1;
        }
        .template-info {
            padding: 2rem;
            background: rgba(255, 255, 255, 0.02);
            border-top: 1px solid var(--surface-border);
        }
        .template-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }
        .template-desc {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }
        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-main);
        }
    </style>
</head>
<body>
    <div class="bg-mesh"></div>

    <header class="navbar">
        <div class="container nav-content">
            <a href="index.php" class="logo" style="text-decoration: none; color: inherit;">
                <span class="logo-icon"></span>
                <span class="logo-text">Aura<span>CV</span></span>
            </a>
            <nav class="nav-links">
                <a href="index.php#features">Features</a>
                <a href="templates.php" style="color: var(--text-main);">Templates</a>
                <a href="index.php#pricing">Pricing</a>
            </nav>
            <div class="nav-cta">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-profile">
                        <?php if (!empty($_SESSION['user_picture'])): ?>
                            <img src="<?php echo $_SESSION['user_picture']; ?>" alt="Profile" class="user-avatar">
                        <?php else: ?>
                            <div class="user-avatar" style="background: var(--gradient); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                <?php echo substr($_SESSION['user_name'], 0, 1); ?>
                            </div>
                        <?php endif; ?>
                        <span class="user-name"><?php echo explode(' ', $_SESSION['user_name'])[0]; ?></span>
                        <a href="logout.php" class="logout-btn" style="font-size: 0.8rem; color: var(--text-muted); text-decoration: none; margin-left: 0.5rem;" title="Logout">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="auth.php" class="btn btn-secondary">Login</a>
                    <a href="auth.php" class="btn btn-primary">Build Now</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="container">
        <section class="templates-hero">
            <div class="badge">Professional Designs</div>
            <h1 class="section-title">Choose Your <span class="gradient-text">Template</span></h1>
            <p class="section-subtitle">Select a template to start building your professional resume.</p>
        </section>

        <div class="templates-grid">
            <!-- Modern Template -->
            <div class="template-card">
                <div class="template-preview">
                    <img src="assets/template-modern.png" alt="Modern Executive Template">
                    <div class="template-overlay">
                        <a href="#" class="btn btn-primary">Select Template</a>
                    </div>
                </div>
                <div class="template-info">
                    <h3 class="template-name">Modern Executive</h3>
                    <p class="template-desc">Clean, high-impact design perfect for corporate roles and leadership positions.</p>
                    <a href="#" class="btn btn-outline btn-full">Preview</a>
                </div>
            </div>

            <!-- Creative Template -->
            <div class="template-card">
                <div class="template-preview">
                    <img src="assets/template-creative.png" alt="Creative Professional Template">
                    <div class="template-overlay">
                        <a href="#" class="btn btn-primary">Select Template</a>
                    </div>
                </div>
                <div class="template-info">
                    <h3 class="template-name">Creative Bold</h3>
                    <p class="template-desc">Express your personality with vibrant colors and a unique, eye-catching layout.</p>
                    <a href="#" class="btn btn-outline btn-full">Preview</a>
                </div>
            </div>

            <!-- Tech/Minimalist Template -->
            <div class="template-card">
                <div class="template-preview">
                    <img src="assets/template-minimal.png" alt="Minimalist Tech Template">
                    <div class="template-overlay">
                        <a href="#" class="btn btn-primary">Select Template</a>
                    </div>
                </div>
                <div class="template-info">
                    <h3 class="template-name">Minimal Tech</h3>
                    <p class="template-desc">Optimized for tech roles, focusing on skills, projects, and high readability.</p>
                    <a href="#" class="btn btn-outline btn-full">Preview</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container footer-content">
            <p>&copy; 2026 AuraCV. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
