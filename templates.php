<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best templates for students | AuraCV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=4">
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
                    <a href="builder.php?template=classic" class="btn btn-amber" style="padding: 0.55rem 1.4rem;">Build Now</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="container">

        <!-- Header (Zety Image 5: "Best templates for students") -->
        <div class="templates-page-header">
            <h1>Best templates for students</h1>
            <p>You can always change your template later.</p>
        </div>

        <!-- 2-Column Catalog Layout: Left Filter Sidebar, Right Template Grid -->
        <div class="templates-catalog-layout">

            <!-- LEFT SIDEBAR: Filters (Image 5) -->
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

                <!-- Filter: Format -->
                <div class="filter-group">
                    <div class="filter-group-title">Experience Level</div>
                    <label class="filter-option">
                        <input type="checkbox" name="level" value="fresher" class="filter-checkbox" checked>
                        <span>Fresher (1 Page)</span>
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="level" value="experienced" class="filter-checkbox" checked>
                        <span>Experienced (2 Pages)</span>
                    </label>
                </div>
            </aside>

            <!-- RIGHT COLUMN: Template Grid -->
            <div class="templates-catalog-grid" id="templates-grid">

                <!-- Template 1: Classic Academic (With Photo, 2 Columns, Traditional) -->
                <div class="zety-template-card active" data-template="classic" data-headshot="photo" data-columns="2-columns" data-style="traditional" data-level="fresher">
                    <div class="zety-card-preview" id="cat-card-1">
                        <img src="assets/template-classic.png" alt="Classic Academic Template">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=classic" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-1">
                        <span class="swatch-dot dot-navy active" title="Navy" data-color="#1e3a8a"></span>
                        <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                        <span class="swatch-dot dot-teal" title="Teal" data-color="#0d9488"></span>
                        <span class="swatch-dot dot-purple" title="Purple" data-color="#7c3aed"></span>
                        <span class="swatch-dot dot-orange" title="Orange" data-color="#ea580c"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Template 2: Minimal Tech (Without Photo, 1 Column, Contemporary) -->
                <div class="zety-template-card" data-template="minimal" data-headshot="no-photo" data-columns="1-column" data-style="contemporary" data-level="fresher">
                    <div class="zety-card-preview" id="cat-card-2">
                        <img src="assets/template-minimal.png" alt="Minimal Tech Template">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=minimal" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=minimal" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-2">
                        <span class="swatch-dot dot-navy" title="Navy" data-color="#1e3a8a"></span>
                        <span class="swatch-dot dot-blue active" title="Royal Blue" data-color="#2563eb"></span>
                        <span class="swatch-dot dot-teal" title="Teal" data-color="#0d9488"></span>
                        <span class="swatch-dot dot-purple" title="Purple" data-color="#7c3aed"></span>
                        <span class="swatch-dot dot-green" title="Green" data-color="#16a34a"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Template 3: Modern Student (With Photo, 2 Columns, Creative) -->
                <div class="zety-template-card" data-template="modern" data-headshot="photo" data-columns="2-columns" data-style="creative" data-level="experienced">
                    <div class="zety-card-preview" id="cat-card-3">
                        <img src="assets/template-modern.png" alt="Modern Template">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic&mode=experienced" class="btn btn-blue">Use this template</a>
                        </div>
                        <span class="recommended-badge">RECOMMENDED</span>
                        <a href="builder.php?template=classic&mode=experienced" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-3">
                        <span class="swatch-dot dot-navy" title="Navy" data-color="#1e3a8a"></span>
                        <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                        <span class="swatch-dot dot-teal active" title="Teal" data-color="#0d9488"></span>
                        <span class="swatch-dot dot-purple" title="Purple" data-color="#7c3aed"></span>
                        <span class="swatch-dot dot-orange" title="Orange" data-color="#ea580c"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

                <!-- Template 4: Creative Bold (Without Photo, 1 Column, Traditional) -->
                <div class="zety-template-card" data-template="creative" data-headshot="no-photo" data-columns="1-column" data-style="traditional" data-level="fresher">
                    <div class="zety-card-preview" id="cat-card-4">
                        <img src="assets/template-creative.png" alt="Creative Bold Template">
                        <div class="zety-card-overlay">
                            <a href="builder.php?template=classic" class="btn btn-blue">Use this template</a>
                        </div>
                        <a href="builder.php?template=classic" class="zoom-btn" title="Preview">&#43;</a>
                    </div>
                    <div class="color-swatches" data-target="cat-card-4">
                        <span class="swatch-dot dot-navy active" title="Navy" data-color="#1e3a8a"></span>
                        <span class="swatch-dot dot-blue" title="Royal Blue" data-color="#2563eb"></span>
                        <span class="swatch-dot dot-teal" title="Teal" data-color="#0d9488"></span>
                        <span class="swatch-dot dot-purple" title="Purple" data-color="#7c3aed"></span>
                        <span class="swatch-dot dot-orange" title="Orange" data-color="#ea580c"></span>
                        <span class="swatch-dot dot-rainbow" title="Custom" data-color="rainbow"></span>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- BOTTOM STICKY FLOATING ACTION BAR (Zety Image 5) -->
    <div class="sticky-bottom-bar">
        <a href="builder.php?template=classic" class="choose-later-link">Choose Later</a>
        <a href="builder.php?template=classic" id="sticky-use-btn" class="btn btn-blue btn-large" style="padding: 0.85rem 2.6rem;">
            Use this template
        </a>
    </div>

    <!-- JS -->
    <script src="script.js?v=4"></script>
</body>
</html>
