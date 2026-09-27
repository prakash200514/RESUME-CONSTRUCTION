<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Builder | AuraCV</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:ital,wght@0,400;0,700;1,400;1,700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css?v=3">

    <style>
        /* Alias new theme variables for builder compatibility */
        :root {
            --primary: var(--navy);
            --primary-dark: var(--navy-dark);
            --primary-glow: rgba(26,60,110,0.18);
            --secondary: var(--navy-light);
            --bg-dark: var(--bg);
            --surface-border: var(--border);
            --text-main: var(--text);
            --text-muted: var(--text-sub);
            --gradient: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 100%);
        }

        /* Overall Page Layout */
        body {
            background-color: #f1f5f9;
            color: #0f172a;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Top Sticky Toolbar */
        .builder-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--surface-border);
            padding: 0.7rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .builder-nav {
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .builder-actions {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        /* Mode Switcher (1-Page Fresher vs 2-Page Experienced) */
        .mode-switch-group {
            display: flex;
            background: #f1f5f9;
            border: 1px solid var(--surface-border);
            border-radius: 10px;
            padding: 3px;
            gap: 4px;
        }

        .btn-mode {
            background: none;
            border: none;
            color: var(--text-muted);
            padding: 0.45rem 0.9rem;
            font-size: 0.82rem;
            font-weight: 600;
            border-radius: 7px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-mode:hover {
            color: var(--text-main);
        }

        .btn-mode.active {
            background: var(--gradient);
            color: #ffffff;
            box-shadow: 0 2px 8px var(--primary-glow);
        }

        /* Workspace Grid: Form on Left, Live Preview on Right */
        .workspace-container {
            display: flex;
            max-width: 1600px;
            margin: 0 auto;
            gap: 1.5rem;
            padding: 1.5rem 1.5rem 4rem 1.5rem;
            position: relative;
        }

        /* Left Side: Form Panel */
        .form-panel {
            width: 460px;
            min-width: 360px;
            max-width: 480px;
            background: #ffffff;
            border: 1px solid var(--surface-border);
            border-radius: 16px;
            padding: 1.5rem;
            height: calc(100vh - 110px);
            overflow-y: auto;
            position: sticky;
            top: 85px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .form-panel.collapsed {
            display: none;
        }

        /* Form Sections & Accordions */
        .form-section {
            background: #f8fafc;
            border: 1px solid var(--surface-border);
            border-radius: 12px;
            margin-bottom: 1.15rem;
            overflow: hidden;
        }

        .form-section.highlight-experienced {
            border-color: #bfdbfe;
        }

        .form-section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.85rem 1rem;
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--text-main);
            background: #ffffff;
            border-bottom: 1px solid var(--surface-border);
            cursor: pointer;
            user-select: none;
        }

        .form-section-title:hover {
            background: #f1f5f9;
        }

        .form-section-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .field-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #475569;
        }

        .field-input, .field-textarea {
            width: 100%;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.55rem 0.75rem;
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.88rem;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .field-input:focus, .field-textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .field-textarea {
            resize: vertical;
            min-height: 60px;
            line-height: 1.4;
        }

        /* Dynamic Repeater Items */
        .repeater-item {
            background: #ffffff;
            border: 1px solid var(--surface-border);
            border-radius: 8px;
            padding: 0.75rem;
            margin-bottom: 0.75rem;
            position: relative;
        }

        .repeater-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
            font-size: 0.8rem;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .btn-remove {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.2rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-remove:hover {
            background: #ef4444;
            color: white;
        }

        .btn-add {
            background: #eff6ff;
            border: 1px dashed #93c5fd;
            color: var(--primary-dark);
            width: 100%;
            padding: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-add:hover {
            background: #dbeafe;
            border-color: var(--primary);
        }

        /* Photo Upload Controls in Form */
        .photo-picker-box {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .form-avatar-preview {
            width: 55px;
            height: 70px;
            border: 1px solid var(--surface-border);
            border-radius: 4px;
            object-fit: cover;
            background: #fff;
        }

        /* Right Side: Preview Panel */
        .preview-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 0;
            gap: 2rem;
        }

        .preview-controls-bar {
            width: 850px;
            max-width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 1rem;
            background: #ffffff;
            border: 1px solid var(--surface-border);
            border-radius: 10px;
            color: #475569;
            font-size: 0.85rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        /* Page Container with Page Tag */
        .page-sheet-container {
            width: 850px;
            max-width: 100%;
            position: relative;
        }

        .page-indicator-tag {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: var(--primary-dark);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        /* The Printed A4 Resume Sheet */
        .resume-sheet {
            background: #ffffff;
            color: #1a1a1a;
            width: 850px;
            max-width: 100%;
            min-height: 1100px;
            padding: 38px 45px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-radius: 2px;
            box-sizing: border-box;
            position: relative;
        }

        /* Classic Academic Template Styles */
        .classic-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            padding-bottom: 12px;
            border-bottom: 2px solid #222;
        }

        /* Page 2 Mini Header */
        .classic-page2-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            margin-bottom: 8px;
            border-bottom: 2px solid #222;
        }

        .classic-page2-name {
            font-family: 'Merriweather', Georgia, serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #111;
            text-transform: uppercase;
        }

        .classic-page2-contact {
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 11.5px;
            color: #444;
        }

        .classic-photo-container {
            width: 105px;
            height: 130px;
            border: 1.5px solid #222;
            overflow: hidden;
            background: #f1f5f9;
            flex-shrink: 0;
            position: relative;
            cursor: pointer;
        }

        .classic-photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            font-size: 10px;
            text-align: center;
            padding: 4px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .classic-photo-container:hover .photo-overlay {
            opacity: 1;
        }

        .classic-identity {
            flex: 1;
            padding-left: 8px;
        }

        .classic-name {
            font-family: 'Merriweather', Georgia, serif;
            font-size: 23px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #111;
            text-transform: uppercase;
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .classic-address {
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 13px;
            color: #222;
            line-height: 1.45;
            white-space: pre-line;
        }

        .classic-contact {
            text-align: right;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 13px;
            color: #222;
            line-height: 1.5;
            flex-shrink: 0;
            white-space: pre-line;
        }

        /* Section Rows */
        .classic-row {
            display: flex;
            width: 100%;
            border-bottom: 1.5px solid #222;
            padding: 9px 0;
            box-sizing: border-box;
        }

        .classic-col-title {
            width: 25%;
            min-width: 160px;
            padding-right: 15px;
            font-family: 'Merriweather', Georgia, serif;
            font-style: italic;
            font-weight: 700;
            font-size: 15px;
            color: #111;
            line-height: 1.25;
            box-sizing: border-box;
        }

        .classic-col-content {
            width: 75%;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 12.5px;
            color: #1a1a1a;
            line-height: 1.35;
            box-sizing: border-box;
        }

        #view-address,
        #view-contact,
        #view-objective,
        #view-skills,
        .exp-desc {
            white-space: pre-line;
        }

        /* Work Experience Entry */
        .exp-entry {
            margin-bottom: 7px;
            line-height: 1.35;
        }
        .exp-entry:last-child {
            margin-bottom: 0;
        }
        .exp-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 1px;
        }
        .exp-company {
            font-family: 'Merriweather', Georgia, serif;
            font-weight: 700;
            font-size: 13px;
            color: #111;
        }
        .exp-duration {
            font-size: 12px;
            color: #333;
            font-weight: 600;
        }
        .exp-role {
            font-style: italic;
            font-size: 12.5px;
            color: #222;
            margin-bottom: 2px;
        }
        .exp-desc {
            font-size: 12px;
            color: #333;
            line-height: 1.35;
        }

        /* Education Entry */
        .edu-entry {
            margin-bottom: 6px;
            line-height: 1.3;
        }
        .edu-entry:last-child {
            margin-bottom: 0;
        }
        .edu-school {
            font-family: 'Merriweather', Georgia, serif;
            font-weight: 700;
            font-style: italic;
            font-size: 13px;
            color: #111;
            line-height: 1.3;
        }
        .edu-degree {
            font-size: 12px;
            color: #333;
            line-height: 1.3;
        }
        .edu-year {
            font-size: 12px;
            color: #333;
            line-height: 1.3;
        }

        /* Project Entry */
        .project-entry {
            margin-bottom: 7px;
            line-height: 1.35;
        }
        .project-entry:last-child {
            margin-bottom: 0;
        }
        .project-heading {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12.5px;
            color: #111;
            margin-bottom: 1px;
            line-height: 1.3;
        }
        .project-tech {
            font-size: 12px;
            margin-bottom: 2px;
            line-height: 1.35;
        }
        .project-desc {
            font-size: 12px;
            color: #333;
            line-height: 1.35;
        }

        /* Bullet List */
        .diamond-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .diamond-list li {
            position: relative;
            padding-left: 0;
            margin-bottom: 3.5px;
            font-size: 12.5px;
            color: #222;
        }
        .diamond-list li:last-child {
            margin-bottom: 0;
        }

        /* Toast notification */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: #10b981;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }
        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Responsive Layout */
        @media (max-width: 1100px) {
            .workspace-container {
                flex-direction: column;
                align-items: center;
            }
            .form-panel {
                width: 100%;
                max-width: 850px;
                height: auto;
                position: static;
            }
        }

        /* Print Media Styles */
        @media print {
            body {
                background: white !important;
                color: black !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .builder-header,
            .form-panel,
            .preview-controls-bar,
            .page-indicator-tag,
            .bg-mesh,
            .toast,
            .photo-overlay {
                display: none !important;
            }
            .workspace-container {
                padding: 0 !important;
                margin: 0 !important;
                display: block !important;
            }
            .preview-panel {
                width: 100% !important;
                display: block !important;
                gap: 0 !important;
            }
            .page-sheet-container {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .resume-sheet {
                box-shadow: none !important;
                border-radius: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 12mm 15mm !important;
                margin: 0 auto !important;
                min-height: auto !important;
            }
            /* Page Breaks */
            .page-sheet-container.page-1 {
                break-after: page !important;
                page-break-after: always !important;
            }
            .page-sheet-container.page-2 {
                break-before: page !important;
                page-break-before: always !important;
            }
            @page {
                size: A4 portrait;
                margin: 0;
            }
        }
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>

    <!-- Top Action Bar -->
    <header class="builder-header">
        <div class="builder-nav">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <a href="templates.php" class="btn btn-outline-dark" style="padding: 0.45rem 1rem; font-size: 0.85rem;">
                    &larr; Templates
                </a>
                <a href="index.php" class="logo" style="text-decoration: none; color: inherit; font-size: 1.35rem;">
                    <span class="logo-badge" style="width:24px; height:24px;"></span>
                    <span>aura</span>cv
                </a>
            </div>

            <!-- 1 Page vs 2 Page Toggle -->
            <div class="mode-switch-group">
                <button type="button" class="btn-mode active" id="btn-mode-1page" onclick="setResumeMode('1page')">
                    &#127891; 1 Page (Fresher)
                </button>
                <button type="button" class="btn-mode" id="btn-mode-2page" onclick="setResumeMode('2page')">
                    &#128188; 2 Pages (Experienced)
                </button>
            </div>

            <div class="builder-actions">
                <button type="button" class="btn btn-outline-dark" id="btn-toggle-form" onclick="toggleFormPanel();" style="padding:0.5rem 0.9rem; font-size:0.85rem;">
                    Hide Form
                </button>
                <button type="button" class="btn btn-outline-dark" onclick="loadSampleData();" style="padding:0.5rem 0.9rem; font-size:0.85rem;">
                    Fill Sample
                </button>
                <button type="button" class="btn btn-outline-dark" onclick="clearAllFields();" style="padding:0.5rem 0.9rem; font-size:0.85rem;">
                    Clear
                </button>
                <button type="button" class="btn btn-blue" onclick="saveToStorage();" style="padding:0.5rem 1.1rem; font-size:0.85rem;">
                    Save Draft
                </button>
                <button type="button" class="btn btn-amber" onclick="window.print();" style="padding:0.55rem 1.4rem; font-size:0.9rem;">
                    &#128424; Download PDF
                </button>
            </div>
        </div>
    </header>

    <!-- Main Workspace -->
    <div class="workspace-container">
        
        <!-- ==================== LEFT: STRUCTURED INPUT FORM ==================== -->
        <aside class="form-panel" id="form-panel">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="font-size: 1.15rem; color: var(--text-main);" id="form-panel-title">Fresher Resume Details</h3>
                <span style="font-size: 0.75rem; color: var(--text-muted);" id="form-panel-mode-badge">1-Page Mode</span>
            </div>

            <!-- 1. PERSONAL INFO -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>👤 Personal Details</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div class="field-group">
                        <label>Candidate Full Name</label>
                        <input type="text" class="field-input" id="inp-name" placeholder="e.g. ALEXANDER J. MORGAN" oninput="syncToResume()">
                    </div>

                    <div class="field-group">
                        <label>Profile Photo</label>
                        <div class="photo-picker-box">
                            <img src="assets/placeholder-avatar.svg" id="form-avatar-img" class="form-avatar-preview" alt="Preview">
                            <div>
                                <input type="file" id="inp-photo" accept="image/*" style="display: none;" onchange="handlePhotoUpload(this)">
                                <button type="button" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.4rem 0.8rem;" onclick="document.getElementById('inp-photo').click()">Upload Image</button>
                            </div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label>Address (Multi-line)</label>
                        <textarea class="field-textarea" id="inp-address" rows="3" placeholder="7/234 Mainroad,&#10;Thimmarajapuram, Palayamkottai,&#10;Tirunelveli-627353" oninput="syncToResume()"></textarea>
                    </div>

                    <div class="field-group">
                        <label>Email Address</label>
                        <input type="email" class="field-input" id="inp-email" placeholder="e.g. alex.morgan@gmail.com" oninput="syncToResume()">
                    </div>

                    <div class="field-group">
                        <label>Phone Number</label>
                        <input type="text" class="field-input" id="inp-phone" placeholder="e.g. +91 82703 65246" oninput="syncToResume()">
                    </div>

                    <div class="field-group">
                        <label>Date of Birth</label>
                        <input type="text" class="field-input" id="inp-dob" placeholder="e.g. DOB 14 / 07 / 2005" oninput="syncToResume()">
                    </div>
                </div>
            </div>

            <!-- 2. CAREER OBJECTIVE / PROFESSIONAL SUMMARY -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span id="label-objective-title">🎯 Career Objective</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div class="field-group">
                        <label id="label-objective-field">Objective Statement</label>
                        <textarea class="field-textarea" id="inp-objective" rows="4" placeholder="To Secure a Strategic Role in a leading High-Tech Company..." oninput="syncToResume()"></textarea>
                    </div>
                </div>
            </div>

            <!-- 3. WORK EXPERIENCE (For 2-Page / Experienced) -->
            <div class="form-section highlight-experienced" id="form-section-experience" style="display: none;">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>💼 Work Experience (Experienced)</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div id="experience-repeater">
                        <!-- Dynamic experience entries populated by JS -->
                    </div>
                    <button type="button" class="btn-add" onclick="addExperienceItem()">+ Add Work Experience</button>
                </div>
            </div>

            <!-- 4. EDUCATION -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>🎓 Education</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div id="education-repeater">
                        <!-- Dynamic education entries populated by JS -->
                    </div>
                    <button type="button" class="btn-add" onclick="addEducationItem()">+ Add Education Entry</button>
                </div>
            </div>

            <!-- 5. TECHNICAL SKILLS -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>🛠️ Technical Skills</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div class="field-group">
                        <label>Skills Lines (One per line)</label>
                        <textarea class="field-textarea" id="inp-skills" rows="4" placeholder="Python, Java&#10;AI-Assisted Full Stack Developer&#10;Prompt Engineering For Development" oninput="syncToResume()"></textarea>
                    </div>
                </div>
            </div>

            <!-- 6. PROJECTS -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>💼 Projects</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div id="projects-repeater">
                        <!-- Dynamic project entries populated by JS -->
                    </div>
                    <button type="button" class="btn-add" onclick="addProjectItem()">+ Add Project</button>
                </div>
            </div>

            <!-- 7. INTERESTS -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>🌟 Interests</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div class="field-group">
                        <label>Interests List (One per line - diamond bullets auto-added)</label>
                        <textarea class="field-textarea" id="inp-interests" rows="3" placeholder="Python, Java, Html, CSS, Javascript, MYSQL, PHP, Dot Net&#10;Website Designing, Animation (Figma)&#10;MongoDB, Express.js, React.js, Node.js" oninput="syncToResume()"></textarea>
                    </div>
                </div>
            </div>

            <!-- 8. ACHIEVEMENTS & AWARDS -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>🏆 Achievements & Awards</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div class="field-group">
                        <label>Achievements (One per line - diamond bullets auto-added)</label>
                        <textarea class="field-textarea" id="inp-achievements" rows="4" placeholder="Participate in Web Designing( Code Debugging)&#10;Python by (NPTEL)&#10;Internship (AI & ML, WEB DEVELOPMENT)" oninput="syncToResume()"></textarea>
                    </div>
                </div>
            </div>

            <!-- 9. LINKS -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>🔗 Links</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div class="field-group">
                        <label>LinkedIn URL</label>
                        <input type="text" class="field-input" id="inp-linkedin" placeholder="https://www.linkedin.com/in/username" oninput="syncToResume()">
                    </div>
                    <div class="field-group">
                        <label>GitHub URL</label>
                        <input type="text" class="field-input" id="inp-github" placeholder="https://github.com/username" oninput="syncToResume()">
                    </div>
                </div>
            </div>

            <!-- 10. DECLARATION -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>📜 Declaration</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div class="field-group">
                        <label>Declaration Text</label>
                        <textarea class="field-textarea" id="inp-declaration" rows="2" placeholder="I hereby declare that above information is correct to the best of my knowledge and belief." oninput="syncToResume()"></textarea>
                    </div>
                </div>
            </div>

        </aside>

        <!-- ==================== RIGHT: LIVE TEMPLATE PREVIEW ==================== -->
        <main class="preview-panel">
            <div class="preview-controls-bar">
                <span id="preview-mode-status">📄 Mode: <b>1-Page Fresher Resume</b> (Optimized for single A4 page)</span>
                <span>Format: <b>A4 Standard</b></span>
            </div>

            <!-- PAGE 1 CONTAINER -->
            <div class="page-sheet-container page-1" id="sheet-container-page1">
                <div class="page-indicator-tag" id="tag-page-1">Page 1 of 1</div>
                
                <article class="resume-sheet" id="resume-page-1">
                    <!-- HEADER -->
                    <header class="classic-header">
                        <!-- Photo Box -->
                        <div class="classic-photo-container" onclick="document.getElementById('inp-photo').click();" title="Click to upload/change photo">
                            <img id="resume-photo" src="assets/placeholder-avatar.svg" alt="Candidate Photo">
                            <div class="photo-overlay">Change Photo</div>
                        </div>

                        <!-- Name & Address -->
                        <div class="classic-identity">
                            <h1 class="classic-name" id="view-name">ALEXANDER J. MORGAN</h1>
                            <div class="classic-address" id="view-address">7/234 Innovation Main Road,&#10;Cyber Valley Tech Park,&#10;Palayamkottai, Tirunelveli-627353</div>
                        </div>

                        <!-- Right Contact Details -->
                        <div class="classic-contact" id="view-contact">alex.morgan2024@gmail.com&#10;+91 98765 43210&#10;DOB 14 / 07 / 2005</div>
                    </header>

                    <!-- OBJECTIVE / PROFESSIONAL SUMMARY -->
                    <section class="classic-row">
                        <div class="classic-col-title" id="view-objective-title">Objective</div>
                        <div class="classic-col-content" id="view-objective">To Secure a Strategic Role in a leading High-Tech Company where I can contribute to key initiatives through precise insight and dedicated execution, ensuring efficient achievement of project goals.</div>
                    </section>

                    <!-- WORK EXPERIENCE ROW (Rendered only on Page 1 in 2-page mode) -->
                    <section class="classic-row" id="row-experience" style="display: none;">
                        <div class="classic-col-title">Work<br>Experience</div>
                        <div class="classic-col-content" id="view-experience"></div>
                    </section>

                    <!-- EDUCATION (On Page 1 for 1-Page mode, or moved to Page 2 in 2-Page mode) -->
                    <section class="classic-row" id="row-education-page1">
                        <div class="classic-col-title">Education</div>
                        <div class="classic-col-content" id="view-education"></div>
                    </section>

                    <!-- TECHNICAL SKILLS -->
                    <section class="classic-row" id="row-skills">
                        <div class="classic-col-title">Technical<br>Skills</div>
                        <div class="classic-col-content" id="view-skills">Python, Java, C++&#10;AI-Assisted Full Stack Developer&#10;Prompt Engineering For Development</div>
                    </section>

                    <!-- PROJECTS (On Page 1 for 1-Page mode) -->
                    <section class="classic-row" id="row-projects-page1">
                        <div class="classic-col-title">Projects</div>
                        <div class="classic-col-content" id="view-projects-page1"></div>
                    </section>

                    <!-- INTERESTS (On Page 1 for 1-Page mode) -->
                    <section class="classic-row" id="row-interests-page1">
                        <div class="classic-col-title">Interests</div>
                        <div class="classic-col-content">
                            <ul class="diamond-list" id="view-interests-list-page1"></ul>
                        </div>
                    </section>

                    <!-- ACHIEVEMENTS & AWARDS (On Page 1 for 1-Page mode) -->
                    <section class="classic-row" id="row-achievements-page1">
                        <div class="classic-col-title">Achievements<br>& Awards</div>
                        <div class="classic-col-content">
                            <ul class="diamond-list" id="view-achievements-list-page1"></ul>
                        </div>
                    </section>

                    <!-- LINKS (On Page 1 for 1-Page mode) -->
                    <section class="classic-row" id="row-links-page1">
                        <div class="classic-col-title">Links</div>
                        <div class="classic-col-content" id="view-links-page1"></div>
                    </section>

                    <!-- DECLARATION (On Page 1 for 1-Page mode) -->
                    <section class="classic-row" id="row-declaration-page1">
                        <div class="classic-col-title">Declaration</div>
                        <div class="classic-col-content" id="view-declaration-page1">I hereby declare that above information is correct to the best of my knowledge and belief.</div>
                    </section>

                </article>
            </div>

            <!-- PAGE 2 CONTAINER (Active only in 2-Page mode) -->
            <div class="page-sheet-container page-2" id="sheet-container-page2" style="display: none;">
                <div class="page-indicator-tag">Page 2 of 2</div>
                
                <article class="resume-sheet" id="resume-page-2">
                    <!-- PAGE 2 MINI HEADER -->
                    <header class="classic-page2-header">
                        <div class="classic-page2-name" id="view-page2-name">ALEXANDER J. MORGAN</div>
                        <div class="classic-page2-contact" id="view-page2-contact">alex.morgan2024@gmail.com | +91 98765 43210</div>
                    </header>

                    <!-- PROJECTS (On Page 2 for 2-Page mode) -->
                    <section class="classic-row">
                        <div class="classic-col-title">Key Projects<br>& Systems</div>
                        <div class="classic-col-content" id="view-projects-page2"></div>
                    </section>

                    <!-- EDUCATION (On Page 2 for 2-Page mode) -->
                    <section class="classic-row">
                        <div class="classic-col-title">Education</div>
                        <div class="classic-col-content" id="view-education-page2"></div>
                    </section>

                    <!-- ACHIEVEMENTS & AWARDS (On Page 2 for 2-Page mode) -->
                    <section class="classic-row">
                        <div class="classic-col-title">Achievements<br>& Awards</div>
                        <div class="classic-col-content">
                            <ul class="diamond-list" id="view-achievements-list-page2"></ul>
                        </div>
                    </section>

                    <!-- INTERESTS (On Page 2 for 2-Page mode) -->
                    <section class="classic-row">
                        <div class="classic-col-title">Interests</div>
                        <div class="classic-col-content">
                            <ul class="diamond-list" id="view-interests-list-page2"></ul>
                        </div>
                    </section>

                    <!-- LINKS (On Page 2 for 2-Page mode) -->
                    <section class="classic-row">
                        <div class="classic-col-title">Links</div>
                        <div class="classic-col-content" id="view-links-page2"></div>
                    </section>

                    <!-- DECLARATION (On Page 2 for 2-Page mode) -->
                    <section class="classic-row">
                        <div class="classic-col-title">Declaration</div>
                        <div class="classic-col-content" id="view-declaration-page2">I hereby declare that above information is correct to the best of my knowledge and belief.</div>
                    </section>

                </article>
            </div>

        </main>

    </div>

    <!-- Toast message -->
    <div class="toast" id="toast">Changes saved successfully!</div>

    <script>
        // Sample Fresher Data (1-Page)
        const sampleFresherData = {
            mode: "1page",
            name: "ALEXANDER J. MORGAN",
            photo: "assets/placeholder-avatar.svg",
            address: "7/234 Innovation Main Road,\nCyber Valley Tech Park,\nPalayamkottai, Tirunelveli-627353",
            email: "alex.morgan2024@gmail.com",
            phone: "+91 98765 43210",
            dob: "DOB 14 / 07 / 2005",
            objective: "To Secure a Strategic Role in a leading High-Tech Company where I can contribute to key initiatives through precise insight and dedicated execution, ensuring efficient achievement of project goals.",
            experiences: [],
            education: [
                { school: "Oakridge International Senior Secondary School", degree: "SSLC - State Board", year: "2021 — 95%" },
                { school: "St. Jude Higher Secondary School", degree: "HSC - State Board", year: "2023 — 88.67%" },
                { school: "National Institute of Science & Technology", degree: "B.Sc. Computer Science", year: "2023-2026 — 8.5 CGPA" },
                { school: "Metropolitan Engineering College", degree: "MCA", year: "Currently Pursuing — 2026-2028" }
            ],
            skills: "Python, Java\nAI-Assisted Full Stack Developer\nPrompt Engineering For Development",
            projects: [
                {
                    name: "MEDICINE STORE",
                    tech: "HTML, CSS, JavaScript, PHP, MySQL.",
                    desc: "Developed a web-based Medicine Store Management System to manage medicines, customer registrations, orders, billing, and inventor."
                },
                {
                    name: "DISEASE PREDICTION SYSTEM",
                    tech: "HTML, CSS, JavaScript, PHP, MySQL",
                    desc: "Developed a web-based Disease Prediction System that predicts possible diseases based on user-entered symptoms"
                }
            ],
            interests: "Python , Java , Html, CSS, Javascript, MYSQL,PHP, Dot Net\nWebsite Designing, Animation (Figma)\nMongoDB ,Express.js ,React.js , Node.js",
            achievements: "Participate in Web Designing( Code Debugging)\nPython by (NPTEL)\nInternship (AI & ML, WEB DEVELOPMENT)\nInternship (WEB DEVELOPING)\nFoundation of Coding python by Naan Mudhalvan Program\nEnglish Language Communication by Naan Mudhalvan Program",
            linkedin: "https://www.linkedin.com/in/alex-morgan-developer/",
            github: "https://github.com/alex-morgan-dev",
            declaration: "I hereby declare that above information is correct to the best of my knowledge and belief."
        };

        // Sample Experienced Data (2-Page)
        const sampleExperiencedData = {
            mode: "2page",
            name: "ALEXANDER J. MORGAN",
            photo: "assets/placeholder-avatar.svg",
            address: "7/234 Innovation Main Road, Suite 400\nCyber Valley Tech Park, Palayamkottai\nTirunelveli - 627353, Tamil Nadu",
            email: "alex.morgan.tech@gmail.com",
            phone: "+91 98765 43210",
            dob: "DOB 14 / 07 / 1999",
            objective: "Results-driven Senior Full Stack Software Engineer with 5+ years of experience architecting high-scale cloud platforms, microservices, and AI-enabled web systems. Proven track record in reducing server latency by 40% and leading cross-functional engineering teams.",
            experiences: [
                {
                    company: "Apex Cloud Solutions Pvt Ltd",
                    role: "Senior Software Engineer (Full Stack)",
                    duration: "2023 — Present | Bangalore, India",
                    desc: "• Spearheaded the migration of monolithic billing engine to distributed microservices on AWS, handling 2.5M daily transactions.\n• Designed and implemented reactive UI architectures using React.js, TypeScript, and TailwindCSS.\n• Mentored a team of 6 associate developers, championing automated CI/CD and clean code practices."
                },
                {
                    company: "InnovateTech Software Labs",
                    role: "Software Developer",
                    duration: "2021 — 2023 | Chennai, India",
                    desc: "• Built robust RESTful APIs in Node.js and PHP MySQL, powering web portals with 99.98% uptime.\n• Implemented Redis caching layer resulting in a 35% decrease in database queries under peak traffic.\n• Collaborated with product designers in Figma to build accessible, mobile-first responsive dashboards."
                }
            ],
            education: [
                { school: "Metropolitan Engineering College", degree: "MCA - Master of Computer Applications", year: "2021 — 8.8 CGPA" },
                { school: "National Institute of Science & Technology", degree: "B.Sc. Computer Science", year: "2019 — 8.6 CGPA" },
                { school: "St. Jude Higher Secondary School", degree: "HSC - State Board", year: "2016 — 91.2%" }
            ],
            skills: "Languages: Python, Java, JavaScript, TypeScript, PHP, SQL\nFrontend & Backend: React.js, Node.js, Express, Next.js, HTML5, CSS3\nCloud & Database: AWS, Docker, Kubernetes, MySQL, MongoDB, Redis\nMethodologies: Agile/Scrum, CI/CD, Microservices, System Design, Prompt Engineering",
            projects: [
                {
                    name: "ENTERPRISE PHARMACY & INVENTORY SUITE",
                    tech: "React.js, Node.js, MySQL, Redis, AWS S3",
                    desc: "Engineered an end-to-end pharmaceutical ERP system managing real-time inventory across 45 branch locations, automated stock notifications, supplier invoicing, and compliance auditing."
                },
                {
                    name: "AI-POWERED CLINICAL DIAGNOSTIC PREDICTOR",
                    tech: "Python, Flask, Scikit-Learn, React, PostgreSQL",
                    desc: "Developed a secure clinical assistant system providing symptom assessment and disease risk scoring using ML regression and classification models with 94% diagnostic accuracy."
                },
                {
                    name: "REAL-TIME LOGISTICS TRACKING PORTAL",
                    tech: "TypeScript, Socket.io, Express, MongoDB",
                    desc: "Built a high-frequency tracking platform providing live GPS telemetry and automated shipment arrival notifications for 500+ daily freight deliveries."
                }
            ],
            interests: "Cloud Distributed Systems & DevOps (Docker, Kubernetes)\nOpen Source AI Development & Model Optimization\nInteractive UI/UX Wireframing & Animation (Figma)\nTechnical Mentorship & Hackathon Judging",
            achievements: "Winner of National Level Hackathon for Smart Healthcare Systems\nCertified AWS Solutions Architect - Associate\nElite Silver Medalist in Advanced Python & Data Structures (NPTEL)\nPublished Technical Paper on AI Assisted Medical Diagnostics",
            linkedin: "https://www.linkedin.com/in/alex-morgan-developer/",
            github: "https://github.com/alex-morgan-dev",
            declaration: "I hereby declare that above information is correct to the best of my knowledge and belief."
        };

        let currentData = JSON.parse(JSON.stringify(sampleFresherData));

        // Switch Resume Mode (1-Page vs 2-Page)
        function setResumeMode(mode) {
            currentData.mode = mode;

            const btn1 = document.getElementById('btn-mode-1page');
            const btn2 = document.getElementById('btn-mode-2page');
            const expSection = document.getElementById('form-section-experience');
            const sheetContainer2 = document.getElementById('sheet-container-page2');
            const statusLabel = document.getElementById('preview-mode-status');
            const panelTitle = document.getElementById('form-panel-title');
            const modeBadge = document.getElementById('form-panel-mode-badge');
            const objTitle = document.getElementById('label-objective-title');
            const objField = document.getElementById('label-objective-field');

            if (mode === '2page') {
                btn1.classList.remove('active');
                btn2.classList.add('active');
                expSection.style.display = 'block';
                sheetContainer2.style.display = 'block';
                document.getElementById('tag-page-1').textContent = 'Page 1 of 2';
                statusLabel.innerHTML = '📄 Mode: <b>2-Page Experienced Resume</b> (Page 1: Experience & Skills | Page 2: Projects & Education)';
                panelTitle.textContent = 'Experienced Resume Details';
                modeBadge.textContent = '2-Page Mode';
                objTitle.textContent = '🎯 Professional Summary';
                objField.textContent = 'Summary Statement';

                // If experiences are empty, supply sample experiences
                if (!currentData.experiences || currentData.experiences.length === 0) {
                    currentData.experiences = JSON.parse(JSON.stringify(sampleExperiencedData.experiences));
                }
            } else {
                btn2.classList.remove('active');
                btn1.classList.add('active');
                expSection.style.display = 'none';
                sheetContainer2.style.display = 'none';
                document.getElementById('tag-page-1').textContent = 'Page 1 of 1';
                statusLabel.innerHTML = '📄 Mode: <b>1-Page Fresher Resume</b> (Optimized for single A4 page)';
                panelTitle.textContent = 'Fresher Resume Details';
                modeBadge.textContent = '1-Page Mode';
                objTitle.textContent = '🎯 Career Objective';
                objField.textContent = 'Objective Statement';
            }

            renderExperienceRepeater();
            renderResume();
            autoSaveDebounced();
        }

        // Accordion toggle
        function toggleSection(headerEl) {
            const body = headerEl.nextElementSibling;
            if (body.style.display === 'none') {
                body.style.display = 'flex';
                headerEl.querySelector('span:last-child').textContent = '▾';
            } else {
                body.style.display = 'none';
                headerEl.querySelector('span:last-child').textContent = '▸';
            }
        }

        // Toggle Form Panel
        function toggleFormPanel() {
            const panel = document.getElementById('form-panel');
            const btn = document.getElementById('btn-toggle-form');
            if (panel.classList.contains('collapsed')) {
                panel.classList.remove('collapsed');
                btn.textContent = '📝 Hide Form';
            } else {
                panel.classList.add('collapsed');
                btn.textContent = '📝 Show Form';
            }
        }

        // Populate Form Fields
        function populateForm() {
            document.getElementById('inp-name').value = currentData.name || '';
            document.getElementById('inp-address').value = currentData.address || '';
            document.getElementById('inp-email').value = currentData.email || '';
            document.getElementById('inp-phone').value = currentData.phone || '';
            document.getElementById('inp-dob').value = currentData.dob || '';
            document.getElementById('inp-objective').value = currentData.objective || '';
            document.getElementById('inp-skills').value = currentData.skills || '';
            document.getElementById('inp-interests').value = currentData.interests || '';
            document.getElementById('inp-achievements').value = currentData.achievements || '';
            document.getElementById('inp-linkedin').value = currentData.linkedin || '';
            document.getElementById('inp-github').value = currentData.github || '';
            document.getElementById('inp-declaration').value = currentData.declaration || '';

            if (currentData.photo) {
                document.getElementById('form-avatar-img').src = currentData.photo;
                document.getElementById('resume-photo').src = currentData.photo;
            }

            renderExperienceRepeater();
            renderEducationRepeater();
            renderProjectsRepeater();
            renderResume();
        }

        // Experience Repeater
        function renderExperienceRepeater() {
            const container = document.getElementById('experience-repeater');
            container.innerHTML = '';
            (currentData.experiences || []).forEach((exp, idx) => {
                const item = document.createElement('div');
                item.className = 'repeater-item';
                item.innerHTML = `
                    <div class="repeater-item-header">
                        <span>Work Experience #${idx + 1}</span>
                        <button type="button" class="btn-remove" onclick="removeExperienceItem(${idx})">&times; Remove</button>
                    </div>
                    <div class="field-group" style="margin-bottom: 0.4rem;">
                        <input type="text" class="field-input" placeholder="Company Name" value="${escapeHtml(exp.company)}" oninput="updateExp(${idx}, 'company', this.value)">
                    </div>
                    <div style="display: flex; gap: 0.5rem; margin-bottom: 0.4rem;">
                        <input type="text" class="field-input" placeholder="Job Title / Role" value="${escapeHtml(exp.role)}" oninput="updateExp(${idx}, 'role', this.value)">
                        <input type="text" class="field-input" placeholder="Duration (e.g. 2022 - Present)" value="${escapeHtml(exp.duration)}" oninput="updateExp(${idx}, 'duration', this.value)">
                    </div>
                    <div class="field-group">
                        <textarea class="field-textarea" rows="3" placeholder="Key responsibilities and accomplishments (bullet points)" oninput="updateExp(${idx}, 'desc', this.value)">${escapeHtml(exp.desc)}</textarea>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function addExperienceItem() {
            if (!currentData.experiences) currentData.experiences = [];
            currentData.experiences.push({ company: "New Tech Company", role: "Software Engineer", duration: "2023 — Present | City", desc: "• Built robust features and led project deliverables.\n• Enhanced system reliability and performance." });
            renderExperienceRepeater();
            renderResume();
        }

        function removeExperienceItem(idx) {
            currentData.experiences.splice(idx, 1);
            renderExperienceRepeater();
            renderResume();
        }

        function updateExp(idx, key, val) {
            currentData.experiences[idx][key] = val;
            renderResume();
        }

        // Education Repeater
        function renderEducationRepeater() {
            const container = document.getElementById('education-repeater');
            container.innerHTML = '';
            (currentData.education || []).forEach((edu, idx) => {
                const item = document.createElement('div');
                item.className = 'repeater-item';
                item.innerHTML = `
                    <div class="repeater-item-header">
                        <span>Institution #${idx + 1}</span>
                        <button type="button" class="btn-remove" onclick="removeEducationItem(${idx})">&times; Remove</button>
                    </div>
                    <div class="field-group" style="margin-bottom: 0.4rem;">
                        <input type="text" class="field-input" placeholder="School / College Name" value="${escapeHtml(edu.school)}" oninput="updateEdu(${idx}, 'school', this.value)">
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" class="field-input" placeholder="Degree / Board" value="${escapeHtml(edu.degree)}" oninput="updateEdu(${idx}, 'degree', this.value)">
                        <input type="text" class="field-input" placeholder="Year — Score/CGPA" value="${escapeHtml(edu.year)}" oninput="updateEdu(${idx}, 'year', this.value)">
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function addEducationItem() {
            if (!currentData.education) currentData.education = [];
            currentData.education.push({ school: "New Institution Name", degree: "Degree / Course", year: "2024 — Grade" });
            renderEducationRepeater();
            renderResume();
        }

        function removeEducationItem(idx) {
            currentData.education.splice(idx, 1);
            renderEducationRepeater();
            renderResume();
        }

        function updateEdu(idx, key, val) {
            currentData.education[idx][key] = val;
            renderResume();
        }

        // Projects Repeater
        function renderProjectsRepeater() {
            const container = document.getElementById('projects-repeater');
            container.innerHTML = '';
            (currentData.projects || []).forEach((proj, idx) => {
                const item = document.createElement('div');
                item.className = 'repeater-item';
                item.innerHTML = `
                    <div class="repeater-item-header">
                        <span>Project #${idx + 1}</span>
                        <button type="button" class="btn-remove" onclick="removeProjectItem(${idx})">&times; Remove</button>
                    </div>
                    <div class="field-group" style="margin-bottom: 0.4rem;">
                        <input type="text" class="field-input" placeholder="PROJECT NAME (UPPERCASE)" value="${escapeHtml(proj.name)}" oninput="updateProj(${idx}, 'name', this.value)">
                    </div>
                    <div class="field-group" style="margin-bottom: 0.4rem;">
                        <input type="text" class="field-input" placeholder="Technologies Used (e.g. HTML, CSS, PHP)" value="${escapeHtml(proj.tech)}" oninput="updateProj(${idx}, 'tech', this.value)">
                    </div>
                    <div class="field-group">
                        <textarea class="field-textarea" rows="2" placeholder="Project Description" oninput="updateProj(${idx}, 'desc', this.value)">${escapeHtml(proj.desc)}</textarea>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function addProjectItem() {
            if (!currentData.projects) currentData.projects = [];
            currentData.projects.push({ name: "NEW PROJECT TITLE", tech: "HTML, CSS, JavaScript, PHP", desc: "Description of the project features, technologies, and achievements." });
            renderProjectsRepeater();
            renderResume();
        }

        function removeProjectItem(idx) {
            currentData.projects.splice(idx, 1);
            renderProjectsRepeater();
            renderResume();
        }

        function updateProj(idx, key, val) {
            currentData.projects[idx][key] = val;
            renderResume();
        }

        // Sync Form to Data
        function syncToResume() {
            currentData.name = document.getElementById('inp-name').value;
            currentData.address = document.getElementById('inp-address').value;
            currentData.email = document.getElementById('inp-email').value;
            currentData.phone = document.getElementById('inp-phone').value;
            currentData.dob = document.getElementById('inp-dob').value;
            currentData.objective = document.getElementById('inp-objective').value;
            currentData.skills = document.getElementById('inp-skills').value;
            currentData.interests = document.getElementById('inp-interests').value;
            currentData.achievements = document.getElementById('inp-achievements').value;
            currentData.linkedin = document.getElementById('inp-linkedin').value;
            currentData.github = document.getElementById('inp-github').value;
            currentData.declaration = document.getElementById('inp-declaration').value;

            renderResume();
            autoSaveDebounced();
        }

        // Render Resume DOM for 1-Page or 2-Page mode
        function renderResume() {
            const is2Page = (currentData.mode === '2page');

            // Header (Page 1)
            document.getElementById('view-name').textContent = currentData.name || 'YOUR FULL NAME';
            document.getElementById('view-address').textContent = currentData.address || '';
            
            const contactParts = [];
            if (currentData.email) contactParts.push(currentData.email);
            if (currentData.phone) contactParts.push(currentData.phone);
            if (currentData.dob) contactParts.push(currentData.dob);
            document.getElementById('view-contact').textContent = contactParts.join('\n');

            // Page 2 Mini Header
            document.getElementById('view-page2-name').textContent = currentData.name || 'YOUR FULL NAME';
            const page2Contact = [currentData.email, currentData.phone].filter(Boolean).join(' | ');
            document.getElementById('view-page2-contact').textContent = page2Contact;

            // Objective / Professional Summary
            document.getElementById('view-objective-title').textContent = is2Page ? 'Professional\nSummary' : 'Objective';
            document.getElementById('view-objective').textContent = currentData.objective || '';

            // Skills
            document.getElementById('view-skills').textContent = currentData.skills || '';

            // Work Experience (Shown only in 2-Page mode on Page 1)
            const rowExp = document.getElementById('row-experience');
            const viewExp = document.getElementById('view-experience');
            if (is2Page && currentData.experiences && currentData.experiences.length > 0) {
                rowExp.style.display = 'flex';
                viewExp.innerHTML = '';
                currentData.experiences.forEach(e => {
                    const div = document.createElement('div');
                    div.className = 'exp-entry';
                    div.innerHTML = `<div class="exp-header"><span class="exp-company">${escapeHtml(e.company)}</span><span class="exp-duration">${escapeHtml(e.duration)}</span></div><div class="exp-role">${escapeHtml(e.role)}</div><div class="exp-desc">${escapeHtml(e.desc)}</div>`;
                    viewExp.appendChild(div);
                });
            } else {
                rowExp.style.display = 'none';
            }

            // HTML builders for Education, Projects, Interests, Achievements, Links, Declaration
            function buildEducationHTML() {
                return (currentData.education || []).map(edu => `<div class="edu-entry"><div class="edu-school">${escapeHtml(edu.school)}</div><div class="edu-degree">${escapeHtml(edu.degree)}</div><div class="edu-year">${escapeHtml(edu.year)}</div></div>`).join('');
            }

            function buildProjectsHTML() {
                return (currentData.projects || []).map(p => `<div class="project-entry"><div class="project-heading">${escapeHtml(p.name)}</div><div class="project-tech"><b>Technologies Used:</b> ${escapeHtml(p.tech)}</div><div class="project-desc">${escapeHtml(p.desc)}</div></div>`).join('');
            }

            function buildListHTML(str) {
                if (!str) return '';
                return str.split('\n').filter(l => l.trim()).map(line => {
                    return `<li>✦${escapeHtml(line.replace(/^[✦\*\-\+]\s*/, ''))}</li>`;
                }).join('');
            }

            function buildLinksHTML() {
                let html = '';
                if (currentData.linkedin) html += `<div>LINKEDIN- ${escapeHtml(currentData.linkedin)}</div>`;
                if (currentData.github) html += `<div>GITHUB- ${escapeHtml(currentData.github)}</div>`;
                return html;
            }

            // Section distribution based on Mode:
            if (is2Page) {
                // In 2-Page mode:
                // Page 1 has: Header, Summary, Work Experience, Technical Skills.
                document.getElementById('row-education-page1').style.display = 'none';
                document.getElementById('row-projects-page1').style.display = 'none';
                document.getElementById('row-interests-page1').style.display = 'none';
                document.getElementById('row-achievements-page1').style.display = 'none';
                document.getElementById('row-links-page1').style.display = 'none';
                document.getElementById('row-declaration-page1').style.display = 'none';

                // Page 2 has: Mini Header, Projects, Education, Achievements, Interests, Links, Declaration
                document.getElementById('view-projects-page2').innerHTML = buildProjectsHTML();
                document.getElementById('view-education-page2').innerHTML = buildEducationHTML();
                document.getElementById('view-achievements-list-page2').innerHTML = buildListHTML(currentData.achievements);
                document.getElementById('view-interests-list-page2').innerHTML = buildListHTML(currentData.interests);
                document.getElementById('view-links-page2').innerHTML = buildLinksHTML();
                document.getElementById('view-declaration-page2').textContent = currentData.declaration || '';
            } else {
                // In 1-Page mode:
                // Page 1 has everything!
                document.getElementById('row-education-page1').style.display = 'flex';
                document.getElementById('row-projects-page1').style.display = 'flex';
                document.getElementById('row-interests-page1').style.display = 'flex';
                document.getElementById('row-achievements-page1').style.display = 'flex';
                document.getElementById('row-links-page1').style.display = 'flex';
                document.getElementById('row-declaration-page1').style.display = 'flex';

                document.getElementById('view-education').innerHTML = buildEducationHTML();
                document.getElementById('view-projects-page1').innerHTML = buildProjectsHTML();
                document.getElementById('view-interests-list-page1').innerHTML = buildListHTML(currentData.interests);
                document.getElementById('view-achievements-list-page1').innerHTML = buildListHTML(currentData.achievements);
                document.getElementById('view-links-page1').innerHTML = buildLinksHTML();
                document.getElementById('view-declaration-page1').textContent = currentData.declaration || '';
            }
        }

        // Photo Upload Handling
        function handlePhotoUpload(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentData.photo = e.target.result;
                    document.getElementById('form-avatar-img').src = e.target.result;
                    document.getElementById('resume-photo').src = e.target.result;
                    saveToStorage();
                    showToast('Photo updated successfully!');
                };
                reader.readAsDataURL(file);
            }
        }

        // Local Storage Persistence
        function saveToStorage() {
            localStorage.setItem('auracv_user_resume_data', JSON.stringify(currentData));
            showToast('Draft saved!');
        }

        let debounceTimer;
        function autoSaveDebounced() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                localStorage.setItem('auracv_user_resume_data', JSON.stringify(currentData));
            }, 800);
        }

        function loadFromStorage() {
            const saved = localStorage.getItem('auracv_user_resume_data');
            if (saved) {
                try {
                    currentData = JSON.parse(saved);
                } catch(e) {
                    currentData = JSON.parse(JSON.stringify(sampleFresherData));
                }
            } else {
                currentData = JSON.parse(JSON.stringify(sampleFresherData));
            }
            setResumeMode(currentData.mode || '1page');
            populateForm();
        }

        // Quick Fill Sample
        function loadSampleData() {
            if (currentData.mode === '2page') {
                currentData = JSON.parse(JSON.stringify(sampleExperiencedData));
            } else {
                currentData = JSON.parse(JSON.stringify(sampleFresherData));
            }
            setResumeMode(currentData.mode);
            populateForm();
            saveToStorage();
            showToast('Sample data loaded for ' + (currentData.mode === '2page' ? 'Experienced' : 'Fresher') + ' mode!');
        }

        // Clear All Fields
        function clearAllFields() {
            if (confirm('Are you sure you want to clear all fields to start blank?')) {
                const mode = currentData.mode;
                currentData = {
                    mode: mode,
                    name: "",
                    photo: "assets/placeholder-avatar.svg",
                    address: "",
                    email: "",
                    phone: "",
                    dob: "",
                    objective: "",
                    experiences: mode === '2page' ? [{ company: "", role: "", duration: "", desc: "" }] : [],
                    education: [{ school: "", degree: "", year: "" }],
                    skills: "",
                    projects: [{ name: "", tech: "", desc: "" }],
                    interests: "",
                    achievements: "",
                    linkedin: "",
                    github: "",
                    declaration: "I hereby declare that above information is correct to the best of my knowledge and belief."
                };
                populateForm();
                saveToStorage();
                showToast('Cleared all fields.');
            }
        }

        // Helper: Escape HTML
        function escapeHtml(text) {
            if (!text) return '';
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Toast display
        function showToast(msg) {
            const toast = document.getElementById('toast');
            toast.textContent = msg;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }

        // Initialize on load
        window.addEventListener('DOMContentLoaded', () => {
            loadFromStorage();
        });
    </script>
</body>
</html>
