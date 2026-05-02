<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuraCV | Elevate Your Career with Premium Resumes</title>
    <meta name="description" content="Create professional, high-impact resumes in minutes with AuraCV. Modern templates, smart AI suggestions, and stunning designs.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    
    <style>
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
        .user-profile:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
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
        .logout-btn {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-decoration: none;
            margin-left: 0.5rem;
        }
        .logout-btn:hover {
            color: #f87171;
        }
    </style>
</head>
<body>
    <!-- Background Mesh Gradient -->
    <div class="bg-mesh"></div>

    <header class="navbar">
        <div class="container nav-content">
            <div class="logo">
                <span class="logo-icon"></span>
                <span class="logo-text">Aura<span>CV</span></span>
            </div>
            <nav class="nav-links">
                <a href="#features">Features</a>
                <a href="#templates">Templates</a>
                <a href="#pricing">Pricing</a>
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
                        <a href="logout.php" class="logout-btn" title="Logout">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="auth.php" class="btn btn-secondary">Login</a>
                    <a href="auth.php" class="btn btn-primary">Build Now</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <section class="hero section">
            <div class="container hero-grid">
                <div class="hero-content" data-aos="fade-up">
                    <div class="badge">Next Generation Resume Builder</div>
                    <h1 class="hero-title">Elevate Your Career with <span class="gradient-text">AuraCV</span></h1>
                    <p class="hero-subtitle">Craft a stunning, professional resume in minutes. Stand out from the crowd with our premium templates designed for modern recruitment.</p>
                    <div class="hero-actions">
                        <a href="auth.php" class="btn btn-large btn-primary">Start Building Free</a>
                        <a href="#templates" class="btn btn-large btn-outline">Explore Templates</a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-num">500k+</span>
                            <span class="stat-label">Resumes Created</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-num">98%</span>
                            <span class="stat-label">Hire Rate</span>
                        </div>
                    </div>
                </div>
                <div class="hero-visual" data-aos="fade-left">
                    <div class="resume-card-preview floating">
                        <img src="assets/hero-resume.png" alt="AuraCV Resume Preview" id="hero-img">
                        <div class="glow-effect"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Designed for <span class="gradient-text">Success</span></h2>
                    <p class="section-subtitle">Powerful tools to help you land your dream job.</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-icon">✨</div>
                        <h3>Smart Suggestions</h3>
                        <p>Our AI-powered engine suggests the best skills and descriptions for your role.</p>
                    </div>
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon">🎨</div>
                        <h3>Premium Templates</h3>
                        <p>Expertly crafted designs that pass ATS filters and wow recruiters.</p>
                    </div>
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon">🚀</div>
                        <h3>One-Click Export</h3>
                        <p>Export to PDF, Word, or share your resume via a private link instantly.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-content">
            <p>&copy; 2026 AuraCV. All rights reserved.</p>
        </div>
    </footer>

    <!-- JS -->
    <script src="script.js"></script>
</body>
</html>
