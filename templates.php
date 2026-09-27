<?php 
session_start(); 
$exp = isset($_GET['exp']) ? $_GET['exp'] : '';
$student = isset($_GET['student']) ? $_GET['student'] : '';
$years = isset($_GET['years']) ? $_GET['years'] : '';
$education = isset($_GET['education']) ? $_GET['education'] : '';

// Check if user came via experienced path (>3 years: 3-5, 5-10, 10+)
$isExperienced = ($exp === 'experienced' || in_array($years, ['3-5', '5-10', '10-plus']));
$activeTab = $isExperienced ? 'experienced' : 'student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="html-title"><?php echo $isExperienced ? 'Best templates for experienced candidates' : 'Best templates for students'; ?> | AuraCV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=7">
</head>
<body style="background-color: #ffffff;">

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container nav-content">
            <a href="index.php" class="logo">
                <span class="logo-badge"></span>
                <span>aura</span>cv
            </a>
            <nav class="nav-links">
                <a href="index.php#how-it-works">How It Works</a>
                <a href="templates.php" class="active" style="color:var(--blue);">Templates</a>
                <a href="index.php#templates-showcase">Showcase</a>
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

    <main class="container">

        <!-- Page Header (Matching Image 3 & User Canva Specification) -->
        <div class="templates-page-header">
            <div id="status-badge-container">
                <?php if ($activeTab === 'student'): ?>
                    <div style="display:inline-block; background:#eff6ff; color:#185adb; font-size:0.85rem; font-weight:700; padding:0.35rem 0.95rem; border-radius:100px; margin-bottom:0.75rem; border:1px solid #bfdbfe;">
                        &#127891; Showing recommended 1-page templates for students &amp; campus placements
                    </div>
                <?php else: ?>
                    <div style="display:inline-block; background:#f0fdf4; color:#15803d; font-size:0.85rem; font-weight:700; padding:0.35rem 0.95rem; border-radius:100px; margin-bottom:0.75rem; border:1px solid #bbf7d0;">
                        &#128188; Showing 2-page &amp; career-progression templates for experienced professionals
                    </div>
                <?php endif; ?>
            </div>

            <h1 id="page-main-heading"><?php echo $isExperienced ? 'Best templates for experienced candidates' : 'Best templates for students'; ?></h1>
            <p id="page-main-subtitle">You can always change your template later.</p>

            <!-- Top Segmented Pill Switcher -->
            <div class="template-tabs-container">
                <div class="template-category-switch" role="tablist">
                    <button type="button" class="tab-pill-btn <?php echo $activeTab === 'student' ? 'active' : ''; ?>" id="tab-student" data-category="student">
                        &#127891; Students &amp; Freshers (1-Page)
                    </button>
                    <button type="button" class="tab-pill-btn <?php echo $activeTab === 'experienced' ? 'active' : ''; ?>" id="tab-experienced" data-category="experienced">
                        &#128188; Experienced Candidates (2-Pages)
                    </button>
                </div>
            </div>
        </div>

        <!-- 2-Column Catalog Layout: Left Filter Sidebar, Right Template Grid -->
        <div class="templates-catalog-layout">

            <!-- LEFT SIDEBAR: Filters (Image 3) -->
            <aside class="filter-sidebar">
                <div class="filter-sidebar-header">
                    <h2>Filters</h2>
                    <span class="clear-filters-link" id="clear-all-filters">Clear Filters</span>
                </div>

                <!-- Filter: Headshot -->
                <div class="filter-group">
                    <div class="filter-group-title">Headshot</div>
                    <label class="filter-option">
                        <input type="checkbox" name="headshot" value="photo" class="filter-checkbox" checked>
                        <span>With photo</span>
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="headshot" value="no-photo" class="filter-checkbox" checked>
                        <span>Without photo</span>
                    </label>
                </div>

                <!-- Filter: Columns -->
                <div class="filter-group">
                    <div class="filter-group-title">Columns</div>
                    <label class="filter-option">
                        <input type="checkbox" name="columns" value="1-column" class="filter-checkbox" checked>
                        <span>1 Column</span>
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="columns" value="2-columns" class="filter-checkbox" checked>
                        <span>2 Columns</span>
                    </label>
                </div>

                <!-- Filter: Style -->
                <div class="filter-group">
                    <div class="filter-group-title">Style</div>
                    <label class="filter-option">
                        <input type="checkbox" name="style" value="traditional" class="filter-checkbox" checked>
                        <span>Traditional</span>
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="style" value="creative" class="filter-checkbox" checked>
                        <span>Creative</span>
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="style" value="contemporary" class="filter-checkbox" checked>
                        <span>Contemporary</span>
                    </label>
                </div>

                <!-- Filter: Occupation (Image 3) -->
                <div class="filter-group">
                    <div class="filter-group-title">Occupation</div>
                    <div class="occupation-filter-list" id="occupation-list">
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox" checked><span>All Occupations</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Computer &amp; Technology</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Management &amp; Executive</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Business &amp; Finance</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Office &amp; Administrative</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Retail &amp; Sales</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Healthcare &amp; Medical</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Arts &amp; Design</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Education &amp; Library</span></label>
                        <label class="filter-option"><input type="checkbox" class="filter-checkbox"><span>Architecture &amp; Engineering</span></label>
                    </div>
                    <span class="show-more-toggle" id="toggle-occ-btn">Show more &or;</span>
                </div>
            </aside>

            <!-- RIGHT COLUMN: Template Grid -->
            <div class="templates-catalog-grid" id="templates-grid">

                <!-- ========================================================
                     1. STUDENT TEMPLATES (6 Authentic Canva Formats - Saanvi Patel)
                     ======================================================== -->

                <!-- Student 1. Cascade (Blue sidebar with photo, 2 columns) -->
                <div class="zety-template-card active" data-category="student" data-template="classic" data-headshot="photo" data-columns="2-columns" data-style="traditional" data-mode="1page">
                    <div class="zety-card-preview" id="cat-card-student-1">
                        <img src="assets/canva-template-cascade.svg" alt="Cascade Student Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=1page<?php echo !empty($education) ? '&education=' . urlencode($education) : ''; ?>" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-student-1">
                        <span class="swatch-dot dot-navy active" title="Navy" data-color="#1e3a8a"></span>
                        <span class="swatch-dot dot-green" title="Green" data-color="#16a34a"></span>
                        <span class="swatch-dot dot-orange" title="Orange" data-color="#ea580c"></span>
                        <span class="swatch-dot dot-purple" title="Purple" data-color="#7c3aed"></span>
                        <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Student 2. Concept (Warm centered serif, clean dividers) -->
                <div class="zety-template-card" data-category="student" data-template="concept" data-headshot="no-photo" data-columns="1-column" data-style="creative" data-mode="1page">
                    <div class="zety-card-preview" id="cat-card-student-2">
                        <img src="assets/canva-template-concept.svg" alt="Concept Student Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=1page<?php echo !empty($education) ? '&education=' . urlencode($education) : ''; ?>" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-student-2">
                        <span class="swatch-dot dot-navy active" title="Dark Slate" data-color="#1e293b"></span>
                        <span class="swatch-dot dot-green" title="Green" data-color="#15803d"></span>
                        <span class="swatch-dot dot-purple" title="Purple" data-color="#6b21a8"></span>
                        <span class="swatch-dot dot-blue" title="Navy" data-color="#0f172a"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Student 3. Primo (Olive green header & checkmark bullets) -->
                <div class="zety-template-card" data-category="student" data-template="primo" data-headshot="photo" data-columns="2-columns" data-style="creative" data-mode="1page">
                    <div class="zety-card-preview" id="cat-card-student-3">
                        <img src="assets/canva-template-primo.svg" alt="Primo Student Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=1page<?php echo !empty($education) ? '&education=' . urlencode($education) : ''; ?>" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-student-3">
                        <span class="swatch-dot dot-green active" title="Olive Green" data-color="#65a30d"></span>
                        <span class="swatch-dot dot-teal" title="Aqua" data-color="#06b6d4"></span>
                        <span class="swatch-dot dot-orange" title="Orange" data-color="#f97316"></span>
                        <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Student 4. Modern Dark (Dark slate header banner with photo) -->
                <div class="zety-template-card" data-category="student" data-template="modern" data-headshot="photo" data-columns="2-columns" data-style="contemporary" data-mode="1page">
                    <div class="zety-card-preview" id="cat-card-student-4">
                        <img src="assets/canva-template-modern-dark.svg" alt="Modern Dark Student Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=1page<?php echo !empty($education) ? '&education=' . urlencode($education) : ''; ?>" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-student-4">
                        <span class="swatch-dot dot-navy active" title="Charcoal" data-color="#1e293b"></span>
                        <span class="swatch-dot dot-purple" title="Purple" data-color="#7c3aed"></span>
                        <span class="swatch-dot dot-orange" title="Amber" data-color="#d97706"></span>
                        <span class="swatch-dot dot-blue" title="Navy" data-color="#0f172a"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Student 5. Vibes (Soft rose pink header banner with photo) -->
                <div class="zety-template-card" data-category="student" data-template="vibes" data-headshot="photo" data-columns="2-columns" data-style="contemporary" data-mode="1page">
                    <div class="zety-card-preview" id="cat-card-student-5">
                        <img src="assets/canva-template-vibes-pink.svg" alt="Vibes Student Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=1page<?php echo !empty($education) ? '&education=' . urlencode($education) : ''; ?>" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-student-5">
                        <span class="swatch-dot dot-purple active" title="Pink/Purple" data-color="#ec4899"></span>
                        <span class="swatch-dot dot-teal" title="Cyan" data-color="#06b6d4"></span>
                        <span class="swatch-dot dot-orange" title="Amber" data-color="#f59e0b"></span>
                        <span class="swatch-dot dot-navy" title="Slate" data-color="#334155"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Student 6. Simple Coral (Coral rounded circular icons) -->
                <div class="zety-template-card" data-category="student" data-template="simple" data-headshot="photo" data-columns="1-column" data-style="traditional" data-mode="1page">
                    <div class="zety-card-preview" id="cat-card-student-6">
                        <img src="assets/canva-template-simple-coral.svg" alt="Simple Coral Student Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=1page<?php echo !empty($education) ? '&education=' . urlencode($education) : ''; ?>" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=classic&mode=1page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-student-6">
                        <span class="swatch-dot dot-orange active" title="Coral" data-color="#e11d48"></span>
                        <span class="swatch-dot dot-navy" title="Navy" data-color="#1e3a8a"></span>
                        <span class="swatch-dot dot-green" title="Green" data-color="#16a34a"></span>
                        <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- ========================================================
                     2. EXPERIENCED TEMPLATES (6 Authentic Canva 2-Page Formats)
                     ======================================================== -->

                <!-- Experienced 1. Executive Suite (Alexander Morgan - Operations Manager 6+ Yrs) -->
                <div class="zety-template-card" data-category="experienced" data-template="executive" data-headshot="no-photo" data-columns="1-column" data-style="traditional" data-mode="2page">
                    <div class="zety-card-preview" id="cat-card-exp-1">
                        <img src="assets/canva-template-executive-2page.svg" alt="Executive 2-Page Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=2page" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="experienced-badge">2-PAGE FORMAT</span>
                        <a href="builder.php?template=classic&mode=2page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-exp-1">
                        <span class="swatch-dot dot-navy active" title="Deep Navy" data-color="#0f2748"></span>
                        <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                        <span class="swatch-dot dot-teal" title="Slate" data-color="#334155"></span>
                        <span class="swatch-dot dot-orange" title="Amber" data-color="#b45309"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Experienced 2. Corporate Strategy (Marcus Vance - Corporate Director 8+ Yrs) -->
                <div class="zety-template-card" data-category="experienced" data-template="corporate" data-headshot="no-photo" data-columns="1-column" data-style="traditional" data-mode="2page">
                    <div class="zety-card-preview" id="cat-card-exp-2">
                        <img src="assets/canva-template-corporate-2page.svg" alt="Corporate Strategy 2-Page Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=2page" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="experienced-badge">2-PAGE FORMAT</span>
                        <a href="builder.php?template=classic&mode=2page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-exp-2">
                        <span class="swatch-dot dot-navy active" title="Charcoal" data-color="#1e293b"></span>
                        <span class="swatch-dot dot-blue" title="Navy" data-color="#1e3a8a"></span>
                        <span class="swatch-dot dot-green" title="Forest Green" data-color="#166534"></span>
                        <span class="swatch-dot dot-purple" title="Burgundy" data-color="#881337"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Experienced 3. Staff Tech Lead (Samantha Reed - Cloud Architect 7+ Yrs) -->
                <div class="zety-template-card" data-category="experienced" data-template="techlead" data-headshot="no-photo" data-columns="2-columns" data-style="contemporary" data-mode="2page">
                    <div class="zety-card-preview" id="cat-card-exp-3">
                        <img src="assets/canva-template-techlead-2page.svg" alt="Staff Tech Lead 2-Page Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=2page" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="experienced-badge">2-PAGE FORMAT</span>
                        <a href="builder.php?template=classic&mode=2page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-exp-3">
                        <span class="swatch-dot dot-blue active" title="Cobalt Blue" data-color="#1d4ed8"></span>
                        <span class="swatch-dot dot-teal" title="Cyan" data-color="#0284c7"></span>
                        <span class="swatch-dot dot-green" title="Emerald" data-color="#059669"></span>
                        <span class="swatch-dot dot-navy" title="Slate" data-color="#334155"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Experienced 4. Finance & Risk Controller (David Thorne, CFA - 9+ Yrs) -->
                <div class="zety-template-card" data-category="experienced" data-template="finance" data-headshot="no-photo" data-columns="1-column" data-style="traditional" data-mode="2page">
                    <div class="zety-card-preview" id="cat-card-exp-4">
                        <img src="assets/canva-template-finance-2page.svg" alt="Finance Controller 2-Page Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=2page" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="experienced-badge">2-PAGE FORMAT</span>
                        <a href="builder.php?template=classic&mode=2page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-exp-4">
                        <span class="swatch-dot dot-navy active" title="Dark Navy" data-color="#0d235c"></span>
                        <span class="swatch-dot dot-orange" title="Gold" data-color="#d97706"></span>
                        <span class="swatch-dot dot-green" title="Green" data-color="#16a34a"></span>
                        <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#185adb"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Experienced 5. Principal Product Lead (Elena Rostova - Design Systems 6+ Yrs) -->
                <div class="zety-template-card" data-category="experienced" data-template="product" data-headshot="photo" data-columns="2-columns" data-style="creative" data-mode="2page">
                    <div class="zety-card-preview" id="cat-card-exp-5">
                        <img src="assets/canva-template-product-2page.svg" alt="Principal Product Lead 2-Page Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=2page" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="experienced-badge">2-PAGE FORMAT</span>
                        <a href="builder.php?template=classic&mode=2page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-exp-5">
                        <span class="swatch-dot dot-teal active" title="Dark Teal" data-color="#042f2e"></span>
                        <span class="swatch-dot dot-green" title="Mint" data-color="#0d9488"></span>
                        <span class="swatch-dot dot-purple" title="Purple" data-color="#7c3aed"></span>
                        <span class="swatch-dot dot-orange" title="Coral" data-color="#e11d48"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Experienced 6. VP Marketing & Growth (Rachel Green - 8+ Yrs) -->
                <div class="zety-template-card" data-category="experienced" data-template="marketing" data-headshot="no-photo" data-columns="1-column" data-style="creative" data-mode="2page">
                    <div class="zety-card-preview" id="cat-card-exp-6">
                        <img src="assets/canva-template-marketing-2page.svg" alt="VP Marketing 2-Page Template (Canva style)">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=2page" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="experienced-badge">2-PAGE FORMAT</span>
                        <a href="builder.php?template=classic&mode=2page" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-exp-6">
                        <span class="swatch-dot dot-purple active" title="Rose Wine" data-color="#881337"></span>
                        <span class="swatch-dot dot-orange" title="Crimson" data-color="#be123c"></span>
                        <span class="swatch-dot dot-navy" title="Indigo" data-color="#3730a3"></span>
                        <span class="swatch-dot dot-blue" title="Charcoal" data-color="#1f2937"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- BOTTOM STICKY FLOATING ACTION BAR -->
    <div class="sticky-bottom-bar">
        <a href="builder.php?template=classic<?php echo $isExperienced ? '&mode=2page' : '&mode=1page'; ?>" class="choose-later-link">Choose Later</a>
        <a href="builder.php?template=classic<?php echo $isExperienced ? '&mode=2page' : '&mode=1page'; ?>" id="sticky-use-btn" class="btn btn-blue btn-large" style="padding: 0.85rem 2.8rem;">
            Use this template
        </a>
    </div>

    <!-- JS -->
    <script src="script.js?v=7"></script>
    <script>
        // Category Tabs: Students (1-Page) vs Experienced (2-Pages)
        let currentCategory = '<?php echo $activeTab; ?>';
        const tabStudent = document.getElementById('tab-student');
        const tabExperienced = document.getElementById('tab-experienced');
        const mainHeading = document.getElementById('page-main-heading');
        const statusBadgeContainer = document.getElementById('status-badge-container');
        const htmlTitle = document.getElementById('html-title');
        const stickyBtn = document.getElementById('sticky-use-btn');

        function setCategory(cat, pushHistory = true) {
            currentCategory = cat;
            if (cat === 'experienced') {
                tabExperienced.classList.add('active');
                tabStudent.classList.remove('active');
                mainHeading.textContent = 'Best templates for experienced candidates';
                if (htmlTitle) htmlTitle.textContent = 'Best templates for experienced candidates | AuraCV';
                statusBadgeContainer.innerHTML = '<div style="display:inline-block; background:#f0fdf4; color:#15803d; font-size:0.85rem; font-weight:700; padding:0.35rem 0.95rem; border-radius:100px; margin-bottom:0.75rem; border:1px solid #bbf7d0;">💼 Showing 2-page &amp; career-progression templates for experienced professionals</div>';
                if (stickyBtn) stickyBtn.href = 'builder.php?template=classic&mode=2page';
                if (pushHistory) {
                    history.pushState(null, '', 'templates.php?exp=experienced');
                }
            } else {
                tabStudent.classList.add('active');
                tabExperienced.classList.remove('active');
                mainHeading.textContent = 'Best templates for students';
                if (htmlTitle) htmlTitle.textContent = 'Best templates for students | AuraCV';
                statusBadgeContainer.innerHTML = '<div style="display:inline-block; background:#eff6ff; color:#185adb; font-size:0.85rem; font-weight:700; padding:0.35rem 0.95rem; border-radius:100px; margin-bottom:0.75rem; border:1px solid #bfdbfe;">🎓 Showing recommended 1-page templates for students &amp; campus placements</div>';
                if (stickyBtn) stickyBtn.href = 'builder.php?template=classic&mode=1page';
                if (pushHistory) {
                    history.pushState(null, '', 'templates.php?exp=entry&student=yes');
                }
            }

            // Apply card visibility based on active category & current filters
            if (typeof window.applyCatalogFilters === 'function') {
                window.applyCatalogFilters();
            } else {
                document.querySelectorAll('#templates-grid .zety-template-card').forEach(card => {
                    if (card.getAttribute('data-category') === currentCategory) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        }

        tabStudent.addEventListener('click', () => setCategory('student'));
        tabExperienced.addEventListener('click', () => setCategory('experienced'));

        // Initialize category on load
        setCategory(currentCategory, false);

        // Toggle Occupation List (Show more / Show less)
        const toggleOccBtn = document.getElementById('toggle-occ-btn');
        const occList = document.getElementById('occupation-list');
        if (toggleOccBtn && occList) {
            toggleOccBtn.addEventListener('click', () => {
                occList.classList.toggle('expanded');
                if (occList.classList.contains('expanded')) {
                    toggleOccBtn.innerHTML = 'Show less &and;';
                } else {
                    toggleOccBtn.innerHTML = 'Show more &or;';
                }
            });
        }
    </script>
</body>
</html>
