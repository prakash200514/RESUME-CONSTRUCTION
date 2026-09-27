<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Resume Maker: Build a Professional Student Resume | AuraCV</title>
    <meta name="description" content="Create a professional, ATS-ready resume in 3 simple steps. Pick a template, fill in the blanks, and download your resume.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- CSS (v=5 for instant cache refresh) -->
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>

    <!-- NAVBAR (Zety style clean white header) -->
    <header class="navbar">
        <div class="container nav-content">
            <a href="index.php" class="logo">
                <span class="logo-badge"></span>
                <span>aura</span>cv
            </a>
            <nav class="nav-links">
                <a href="#how-it-works">How It Works</a>
                <a href="templates.php">Templates</a>
                <a href="#templates-showcase">Pick Template</a>
            </nav>
            <div class="nav-cta">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-profile">
                        <?php if (!empty($_SESSION['user_picture'])): ?>
                            <img src="<?php echo htmlspecialchars($_SESSION['user_picture']); ?>" alt="Profile" class="user-avatar">
                        <?php else: ?>
                            <div class="user-avatar" style="background:var(--blue); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:0.85rem;">
                                <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
                            </div>
                        <?php endif; ?>
                        <span class="user-name"><?php echo htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?></span>
                        <a href="logout.php" class="logout-btn" title="Logout">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="auth.php" class="btn btn-outline-dark" style="padding: 0.55rem 1.3rem;">Sign In</a>
                    <a href="experience-level.php" class="btn btn-amber" style="padding: 0.55rem 1.4rem;">Create Resume</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>

        <!-- ============================================================
             ZETY TOP HERO BANNER (Fast. Easy. Effective. — From Screenshot)
             ============================================================ -->
        <section class="zety-intro-hero">
            <div class="container">
                <div class="zety-intro-eyebrow">Fast. Easy. Effective.</div>
                <h1 class="zety-intro-title">AuraCV. The Best Resume Maker Online.</h1>
                <p class="zety-intro-subtitle">
                    Whether you want to build a new resume from scratch or improve an existing one, let AuraCV help you present your work life, personality, and skills on a resume that stands out.
                </p>
                <div class="zety-intro-actions">
                    <a href="experience-level.php" class="btn-zety-amber">Create new resume</a>
                    <a href="templates.php" class="btn-zety-outline">Improve my resume</a>
                </div>
            </div>
        </section>

        <!-- ============================================================
             3-STEP VALUE SECTION (Zety Image 2)
             ============================================================ -->
        <section id="how-it-works" class="process-section">
            <div class="container">

                <div class="process-grid">

                    <!-- Step 1 Card -->
                    <div class="process-card">
                        <div class="process-illustration">
                            <svg width="110" height="110" viewBox="0 0 120 120" fill="none">
                                <rect x="25" y="15" width="70" height="90" rx="6" fill="#FFFFFF" stroke="#D1D5DB" stroke-width="2"/>
                                <rect x="35" y="28" width="30" height="6" rx="2" fill="#185ADB"/>
                                <rect x="35" y="40" width="50" height="3" rx="1.5" fill="#E5E7EB"/>
                                <rect x="35" y="48" width="45" height="3" rx="1.5" fill="#E5E7EB"/>
                                <rect x="35" y="62" width="25" height="4" rx="2" fill="#2563EB"/>
                                <rect x="35" y="72" width="50" height="3" rx="1.5" fill="#E5E7EB"/>
                                <rect x="35" y="80" width="40" height="3" rx="1.5" fill="#E5E7EB"/>
                                <circle cx="80" cy="90" r="14" fill="#FFB800"/>
                                <path d="M75 90L79 94L86 86" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Pick a resume template.</h3>
                        <p>Choose a sleek design and layout to get started. All crafted for students and campus recruiters.</p>
                    </div>

                    <!-- Step 2 Card -->
                    <div class="process-card">
                        <div class="process-illustration">
                            <svg width="140" height="110" viewBox="0 0 150 120" fill="none">
                                <rect x="15" y="20" width="120" height="80" rx="8" fill="#FFFFFF" stroke="#D1D5DB" stroke-width="2"/>
                                <rect x="25" y="32" width="45" height="6" rx="3" fill="#111827"/>
                                <rect x="25" y="48" width="100" height="24" rx="5" fill="#EFF6FF" stroke="#BFDBFE" stroke-width="1.5"/>
                                <rect x="32" y="54" width="12" height="12" rx="3" fill="#185ADB"/>
                                <path d="M35 60L37.5 62.5L41.5 56.5" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <text x="50" y="64" font-family="Inter, sans-serif" font-size="8" font-weight="700" fill="#185ADB">&#9733; Expert Recommended</text>
                                <rect x="25" y="80" width="50" height="12" rx="3" fill="#185ADB"/>
                                <text x="32" y="89" font-family="Inter, sans-serif" font-size="8" font-weight="700" fill="#FFFFFF">ADD SKILL</text>
                            </svg>
                        </div>
                        <h3>Fill in the blanks.</h3>
                        <p>Type in a few words. Let our student resume wizard organize your college, skills, and projects.</p>
                    </div>

                    <!-- Step 3 Card -->
                    <div class="process-card">
                        <div class="process-illustration">
                            <svg width="120" height="110" viewBox="0 0 130 120" fill="none">
                                <rect x="25" y="15" width="65" height="85" rx="6" fill="#FFFFFF" stroke="#D1D5DB" stroke-width="2"/>
                                <rect x="75" y="25" width="40" height="60" rx="6" fill="#F8FAFC" stroke="#93C5FD" stroke-width="1.5"/>
                                <circle cx="95" cy="45" r="8" fill="#2563EB"/>
                                <circle cx="85" cy="65" r="5" fill="#FFB800"/>
                                <circle cx="100" cy="65" r="5" fill="#10B981"/>
                                <circle cx="108" cy="78" r="14" fill="#185ADB"/>
                                <path d="M108 72V84M103 80L108 84L113 80" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Customize your document.</h3>
                        <p>Make it truly yours. 1-page for freshers, 2-page for experienced, and custom color accents.</p>
                    </div>

                </div>

                <div class="process-top-cta" style="margin-bottom: 0;">
                    <a href="experience-level.php" class="btn btn-amber">Create new resume</a>
                    <a href="templates.php" class="btn btn-outline-dark">Improve my resume</a>
                </div>

            </div>
        </section>

        <!-- ============================================================
             HERO SECTION ("Just three simple steps" — Zety Image 3)
             ============================================================ -->
        <section class="hero-zety">
            <div class="container hero-zety-grid">

                <!-- Left Column: 3 Steps & CTA -->
                <div class="hero-left">
                    <h1 class="hero-heading">Just three<br>simple steps</h1>

                    <div class="steps-list">
                        <div class="step-item">
                            <div class="step-num">1</div>
                            <div class="step-text">Select a template from our library of professional designs</div>
                        </div>
                        <div class="step-item">
                            <div class="step-num">2</div>
                            <div class="step-text">Build your resume with our industry-specific bullet points</div>
                        </div>
                        <div class="step-item">
                            <div class="step-num">3</div>
                            <div class="step-text">Download your resume, print it out and get it ready to send!</div>
                        </div>
                    </div>

                    <div class="hero-cta-box">
                        <a href="experience-level.php" class="btn btn-amber btn-large" style="min-width: 280px; font-size: 1.15rem; display:inline-flex;">
                            Create My Resume
                        </a>
                        <p class="terms-note">
                            By clicking Create My Resume, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
                        </p>
                    </div>
                </div>

                <!-- Right Column: Paper Resume Sheet Preview with Zety Decorative Accents -->
                <div class="hero-right hero-preview-container">
                    <!-- Playful Geometric Shapes -->
                    <div class="deco-circle-red"></div>
                    <div class="deco-stripes-pink"></div>
                    <div class="deco-triangle-teal"></div>
                    <div class="deco-wavy-lines"></div>

                    <!-- Clean Paper Resume Sheet -->
                    <div class="paper-resume">
                        <div class="paper-header">
                            <div class="paper-name">Saanvi Patel</div>
                            <div class="paper-role">Computer Science Student &bull; Aspiring Software Engineer</div>
                            <div class="paper-contact">
                                <span>&#128222; +91 98765 43210</span>
                                <span>&#9993; saanvi.patel@email.com</span>
                                <span>&#127760; Bangalore, India</span>
                            </div>
                        </div>

                        <div class="paper-section-title">Education</div>
                        <div class="paper-item">
                            <div class="paper-item-header">
                                <span>B.Tech in Computer Science and Engineering</span>
                                <span style="color:#6b7280; font-weight:normal;">2022 &ndash; 2026</span>
                            </div>
                            <div class="paper-item-sub">National Institute of Technology &bull; CGPA: 8.9 / 10.0</div>
                        </div>

                        <div class="paper-section-title">Key Projects</div>
                        <div class="paper-item">
                            <div class="paper-item-header">
                                <span>Automated Student Placement Portal</span>
                                <span style="color:#6b7280; font-weight:normal;">React, Node.js, SQL</span>
                            </div>
                            <div class="paper-bullet">Engineered full-stack portal used by 2,000+ candidates for campus hiring.</div>
                            <div class="paper-bullet">Integrated real-time ATS resume screening scoring algorithm.</div>
                        </div>

                        <div class="paper-section-title">Skills &amp; Competencies</div>
                        <div class="paper-tags">
                            <span class="paper-tag">Java</span>
                            <span class="paper-tag">Python</span>
                            <span class="paper-tag">React.js</span>
                            <span class="paper-tag">Data Structures</span>
                            <span class="paper-tag">SQL</span>
                            <span class="paper-tag">Git</span>
                            <span class="paper-tag">Communication</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================================
             TEMPLATE SHOWCASE SECTION ("Pick a resume template" — Zety Image 1)
             ============================================================ -->
        <section id="templates-showcase" class="showcase-section">
            <div class="container">
                <h2 class="section-heading-zety">Pick a resume template</h2>

                <div class="templates-showcase-row">

                    <!-- Template 1: Cascade (Canva Style) -->
                    <div class="zety-template-card active" data-template="classic">
                        <div class="zety-card-preview" id="preview-card-1">
                            <img src="assets/canva-template-cascade.svg" alt="Cascade Student Template (Canva Style)">
                            <div class="zety-card-overlay">
                                <a href="builder.php?template=classic&mode=1page" class="btn btn-blue">Use this template</a>
                            </div>
                            <span class="recommended-badge">RECOMMENDED</span>
                            <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                        </div>
                        <div class="color-swatches" data-target="preview-card-1">
                            <span class="swatch-dot dot-navy active" title="Navy" data-color="#1e3a8a"></span>
                            <span class="swatch-dot dot-green" title="Green" data-color="#16a34a"></span>
                            <span class="swatch-dot dot-orange" title="Orange" data-color="#ea580c"></span>
                            <span class="swatch-dot dot-purple" title="Purple" data-color="#7c3aed"></span>
                            <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                            <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                        </div>
                    </div>

                    <!-- Template 2: Concept (Canva Style) -->
                    <div class="zety-template-card" data-template="concept">
                        <div class="zety-card-preview" id="preview-card-2">
                            <img src="assets/canva-template-concept.svg" alt="Concept Student Template (Canva Style)">
                            <div class="zety-card-overlay">
                                <a href="builder.php?template=classic&mode=1page" class="btn btn-blue">Use this template</a>
                            </div>
                            <span class="recommended-badge">RECOMMENDED</span>
                            <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                        </div>
                        <div class="color-swatches" data-target="preview-card-2">
                            <span class="swatch-dot dot-navy active" title="Dark Slate" data-color="#1e293b"></span>
                            <span class="swatch-dot dot-green" title="Green" data-color="#15803d"></span>
                            <span class="swatch-dot dot-purple" title="Purple" data-color="#6b21a8"></span>
                            <span class="swatch-dot dot-blue" title="Navy" data-color="#0f172a"></span>
                            <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                        </div>
                    </div>

                    <!-- Template 3: Primo (Canva Style) -->
                    <div class="zety-template-card" data-template="primo">
                        <div class="zety-card-preview" id="preview-card-3">
                            <img src="assets/canva-template-primo.svg" alt="Primo Student Template (Canva Style)">
                            <div class="zety-card-overlay">
                                <a href="builder.php?template=classic&mode=1page" class="btn btn-blue">Use this template</a>
                            </div>
                            <span class="recommended-badge">RECOMMENDED</span>
                            <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                        </div>
                        <div class="color-swatches" data-target="preview-card-3">
                            <span class="swatch-dot dot-green active" title="Olive Green" data-color="#65a30d"></span>
                            <span class="swatch-dot dot-teal" title="Aqua" data-color="#06b6d4"></span>
                            <span class="swatch-dot dot-orange" title="Orange" data-color="#f97316"></span>
                            <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                            <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                        </div>
                    </div>

                </div>

                <a href="templates.php" class="btn btn-amber btn-large" style="padding: 0.85rem 2.5rem; font-size: 1.1rem;">
                    View more templates
                </a>
            </div>
        </section>

    </main>

    <!-- ============================================================
         STUDENT ONBOARDING WIZARD MODAL (Zety Image 4)
         ============================================================ -->
    <div class="modal-overlay" id="student-wizard-modal">
        <div class="modal-content">
            <button class="modal-close-btn" id="close-wizard-modal">&times;</button>

            <!-- Question 1: Are you a student? -->
            <h2 class="modal-question">Are you a student?</h2>
            <div class="toggle-pills">
                <button class="toggle-pill active" id="btn-student-yes">Yes</button>
                <button class="toggle-pill" id="btn-student-no">No</button>
            </div>

            <!-- Question 2: Education Level -->
            <h3 class="modal-subquestion">What education level are you currently pursuing?</h3>
            <p class="modal-desc">Select the highest level you are working toward so we can organize your resume correctly.</p>

            <div class="education-grid">
                <div class="edu-level-card" data-level="secondary">Secondary School</div>
                <div class="edu-level-card" data-level="diploma">Vocational Certificate or Diploma</div>
                <div class="edu-level-card" data-level="internship">Apprenticeship or Internship Training</div>
                <div class="edu-level-card" data-level="associates">Associates</div>
                <div class="edu-level-card selected" data-level="bachelors">Bachelors (B.Tech / B.Sc / B.Com)</div>
                <div class="edu-level-card" data-level="masters">Masters (M.Tech / MBA / M.Sc)</div>
                <div class="edu-level-card" data-level="phd">Doctorate or Ph.D.</div>
            </div>

            <div style="margin-top: 1.5rem;">
                <a href="builder.php?template=classic&education=bachelors" class="prefer-not-link">Prefer not to answer</a>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer-zety">
        <div class="container footer-zety-content">
            <p>&copy; 2026 AuraCV. Build professional resumes for campus placements and beyond.</p>
            <div class="footer-zety-links">
                <a href="templates.php">Templates</a>
                <a href="#how-it-works">How It Works</a>
                <a href="auth.php">My Account</a>
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script src="script.js?v=4"></script>
</body>
</html>
