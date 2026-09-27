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
    
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* Overall Page Layout */
        body {
            background-color: var(--bg-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Top Sticky Toolbar */
        .builder-header {
            background: rgba(10, 10, 11, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--surface-border);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .builder-nav {
            max-width: 1500px;
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
            background: var(--surface);
            border: 1px solid var(--surface-border);
            border-radius: 16px;
            padding: 1.5rem;
            height: calc(100vh - 110px);
            overflow-y: auto;
            position: sticky;
            top: 85px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .form-panel.collapsed {
            display: none;
        }

        /* Form Sections & Accordions */
        .form-section {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--surface-border);
            border-radius: 12px;
            margin-bottom: 1.25rem;
            overflow: hidden;
        }

        .form-section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.04);
            border-bottom: 1px solid var(--surface-border);
            cursor: pointer;
            user-select: none;
        }

        .form-section-title:hover {
            background: rgba(255, 255, 255, 0.07);
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
            font-weight: 500;
            color: var(--text-muted);
        }

        .field-input, .field-textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--surface-border);
            border-radius: 8px;
            padding: 0.55rem 0.75rem;
            color: #ffffff;
            font-family: inherit;
            font-size: 0.88rem;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .field-input:focus, .field-textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .field-textarea {
            resize: vertical;
            min-height: 60px;
            line-height: 1.4;
        }

        /* Dynamic Repeater Items */
        .repeater-item {
            background: rgba(0, 0, 0, 0.25);
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
            color: var(--secondary);
            font-weight: 600;
        }

        .btn-remove {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
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
            background: rgba(14, 165, 233, 0.15);
            border: 1px dashed rgba(14, 165, 233, 0.4);
            color: var(--secondary);
            width: 100%;
            padding: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-add:hover {
            background: rgba(14, 165, 233, 0.25);
            border-color: var(--secondary);
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
        }

        .preview-controls-bar {
            width: 850px;
            max-width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            padding: 0.5rem 0.75rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--surface-border);
            border-radius: 10px;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* The Printed A4 Resume Sheet */
        .resume-sheet {
            background: #ffffff;
            color: #1a1a1a;
            width: 850px;
            max-width: 100%;
            min-height: 1100px;
            padding: 40px 48px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
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

        .classic-photo-container {
            width: 110px;
            height: 135px;
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
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #111;
            text-transform: uppercase;
            margin-bottom: 6px;
            line-height: 1.2;
        }

        .classic-address {
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 13.5px;
            color: #222;
            line-height: 1.45;
            white-space: pre-line;
        }

        .classic-contact {
            text-align: right;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 13.5px;
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
            padding: 10px 0;
            box-sizing: border-box;
        }

        .classic-col-title {
            width: 25%;
            min-width: 160px;
            padding-right: 15px;
            font-family: 'Merriweather', Georgia, serif;
            font-style: italic;
            font-weight: 700;
            font-size: 15.5px;
            color: #111;
            line-height: 1.25;
            box-sizing: border-box;
        }

        .classic-col-content {
            width: 75%;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 13px;
            color: #1a1a1a;
            line-height: 1.45;
            box-sizing: border-box;
            white-space: pre-line;
        }

        /* Education Entry */
        .edu-entry {
            margin-bottom: 10px;
        }
        .edu-entry:last-child {
            margin-bottom: 0;
        }
        .edu-school {
            font-family: 'Merriweather', Georgia, serif;
            font-weight: 700;
            font-style: italic;
            font-size: 13.5px;
            color: #111;
        }
        .edu-degree {
            font-size: 12.5px;
            color: #333;
        }
        .edu-year {
            font-size: 12.5px;
            color: #333;
        }

        /* Project Entry */
        .project-entry {
            margin-bottom: 12px;
        }
        .project-entry:last-child {
            margin-bottom: 0;
        }
        .project-heading {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
            color: #111;
            margin-bottom: 2px;
        }
        .project-tech {
            font-size: 12.5px;
            margin-bottom: 3px;
        }
        .project-desc {
            font-size: 12.5px;
            color: #333;
            line-height: 1.4;
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
            margin-bottom: 4px;
            font-size: 13px;
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
            }
            .resume-sheet {
                box-shadow: none !important;
                border-radius: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 10mm 15mm !important;
                margin: 0 auto !important;
            }
            @page {
                size: A4 portrait;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="bg-mesh"></div>

    <!-- Top Action Bar -->
    <header class="builder-header">
        <div class="builder-nav">
            <div style="display: flex; align-items: center; gap: 0.8rem;">
                <a href="templates.php" class="btn btn-outline" style="padding: 0.45rem 0.9rem; font-size: 0.88rem;">
                    &larr; Back to Templates
                </a>
                <a href="index.php" class="logo" style="text-decoration: none; color: inherit;">
                    <span class="logo-icon"></span>
                    <span class="logo-text">Aura<span>CV</span></span>
                </a>
                <span class="badge" style="margin: 0; background: rgba(255,255,255,0.08); color: var(--text-main); font-size: 0.8rem;">
                    Template: Classic Academic
                </span>
            </div>

            <div class="builder-actions">
                <button type="button" class="btn btn-outline" id="btn-toggle-form" onclick="toggleFormPanel();">
                    📝 Hide Form
                </button>
                <button type="button" class="btn btn-outline" onclick="loadSampleData();">
                    ⚡ Quick Fill Sample
                </button>
                <button type="button" class="btn btn-outline" onclick="clearAllFields();">
                    🗑️ Clear All
                </button>
                <button type="button" class="btn btn-outline" onclick="saveToStorage();">
                    💾 Save Draft
                </button>
                <button type="button" class="btn btn-primary" onclick="window.print();">
                    🖨️ Print / Export PDF
                </button>
            </div>
        </div>
    </header>

    <!-- Main Workspace -->
    <div class="workspace-container">
        
        <!-- ==================== LEFT: STRUCTURED INPUT FORM ==================== -->
        <aside class="form-panel" id="form-panel">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="font-size: 1.15rem; color: var(--text-main);">Resume Details Form</h3>
                <span style="font-size: 0.75rem; color: var(--text-muted);">Real-time Auto Sync</span>
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

            <!-- 2. CAREER OBJECTIVE -->
            <div class="form-section">
                <div class="form-section-title" onclick="toggleSection(this)">
                    <span>🎯 Career Objective</span>
                    <span>▾</span>
                </div>
                <div class="form-section-body">
                    <div class="field-group">
                        <label>Objective Statement</label>
                        <textarea class="field-textarea" id="inp-objective" rows="4" placeholder="To Secure a Strategic Role in a leading High-Tech Company..." oninput="syncToResume()"></textarea>
                    </div>
                </div>
            </div>

            <!-- 3. EDUCATION -->
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

            <!-- 4. TECHNICAL SKILLS -->
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

            <!-- 5. PROJECTS -->
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

            <!-- 6. INTERESTS -->
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

            <!-- 7. ACHIEVEMENTS & AWARDS -->
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

            <!-- 8. LINKS -->
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

            <!-- 9. DECLARATION -->
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
                <span>⚡ <b>Live Preview:</b> Updates instantly as you type in the form or click on the resume.</span>
                <span>Paper Format: <b>A4 Standard</b></span>
            </div>

            <article class="resume-sheet" id="resume-container">
                
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

                <!-- 1. OBJECTIVE -->
                <section class="classic-row">
                    <div class="classic-col-title">Objective</div>
                    <div class="classic-col-content" id="view-objective">To Secure a Strategic Role in a leading High-Tech Company where I can contribute to key initiatives through precise insight and dedicated execution, ensuring efficient achievement of project goals.</div>
                </section>

                <!-- 2. EDUCATION -->
                <section class="classic-row">
                    <div class="classic-col-title">Education</div>
                    <div class="classic-col-content" id="view-education">
                        <!-- Populated dynamically -->
                    </div>
                </section>

                <!-- 3. TECHNICAL SKILLS -->
                <section class="classic-row">
                    <div class="classic-col-title">Technical<br>Skills</div>
                    <div class="classic-col-content" id="view-skills">Python, Java, C++&#10;AI-Assisted Full Stack Developer&#10;Prompt Engineering For Development</div>
                </section>

                <!-- 4. PROJECTS -->
                <section class="classic-row">
                    <div class="classic-col-title">Projects</div>
                    <div class="classic-col-content" id="view-projects">
                        <!-- Populated dynamically -->
                    </div>
                </section>

                <!-- 5. INTERESTS -->
                <section class="classic-row">
                    <div class="classic-col-title">Interests</div>
                    <div class="classic-col-content" id="view-interests">
                        <ul class="diamond-list" id="view-interests-list"></ul>
                    </div>
                </section>

                <!-- 6. ACHIEVEMENTS & AWARDS -->
                <section class="classic-row">
                    <div class="classic-col-title">Achievements<br>& Awards</div>
                    <div class="classic-col-content" id="view-achievements">
                        <ul class="diamond-list" id="view-achievements-list"></ul>
                    </div>
                </section>

                <!-- 7. LINKS -->
                <section class="classic-row">
                    <div class="classic-col-title">Links</div>
                    <div class="classic-col-content" id="view-links"></div>
                </section>

                <!-- 8. DECLARATION -->
                <section class="classic-row">
                    <div class="classic-col-title">Declaration</div>
                    <div class="classic-col-content" id="view-declaration">I hereby declare that above information is correct to the best of my knowledge and belief.</div>
                </section>

            </article>
        </main>

    </div>

    <!-- Toast message -->
    <div class="toast" id="toast">Changes saved successfully!</div>

    <script>
        // Sample Initial Data (Realistic Dummy Data)
        const sampleData = {
            name: "ALEXANDER J. MORGAN",
            photo: "assets/placeholder-avatar.svg",
            address: "7/234 Innovation Main Road,\nCyber Valley Tech Park,\nPalayamkottai, Tirunelveli-627353",
            email: "alex.morgan2024@gmail.com",
            phone: "+91 98765 43210",
            dob: "DOB 14 / 07 / 2005",
            objective: "To Secure a Strategic Role in a leading High-Tech Company where I can contribute to key initiatives through precise insight and dedicated execution, ensuring efficient achievement of project goals.",
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

        let currentData = JSON.parse(JSON.stringify(sampleData));

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

        // Toggle Form Panel (Split View vs Full Preview)
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

        // Populate Form Fields from Data
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

            renderEducationRepeater();
            renderProjectsRepeater();
            renderResume();
        }

        // Education Repeater in Form
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

        // Projects Repeater in Form
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

        // Sync Form Inputs to currentData and Re-render
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

        // Render Resume Template DOM
        function renderResume() {
            // Header
            document.getElementById('view-name').textContent = currentData.name || 'YOUR FULL NAME';
            document.getElementById('view-address').textContent = currentData.address || '';
            
            const contactParts = [];
            if (currentData.email) contactParts.push(currentData.email);
            if (currentData.phone) contactParts.push(currentData.phone);
            if (currentData.dob) contactParts.push(currentData.dob);
            document.getElementById('view-contact').textContent = contactParts.join('\n');

            // Objective
            document.getElementById('view-objective').textContent = currentData.objective || '';

            // Education
            const eduView = document.getElementById('view-education');
            eduView.innerHTML = '';
            (currentData.education || []).forEach(edu => {
                const div = document.createElement('div');
                div.className = 'edu-entry';
                div.innerHTML = `
                    <div class="edu-school">${escapeHtml(edu.school)}</div>
                    <div class="edu-degree">${escapeHtml(edu.degree)}</div>
                    <div class="edu-year">${escapeHtml(edu.year)}</div>
                `;
                eduView.appendChild(div);
            });

            // Skills
            document.getElementById('view-skills').textContent = currentData.skills || '';

            // Projects
            const projView = document.getElementById('view-projects');
            projView.innerHTML = '';
            (currentData.projects || []).forEach(p => {
                const div = document.createElement('div');
                div.className = 'project-entry';
                div.innerHTML = `
                    <div class="project-heading">${escapeHtml(p.name)}</div>
                    <div class="project-tech"><b>Technologies Used:</b> ${escapeHtml(p.tech)}</div>
                    <div class="project-desc">${escapeHtml(p.desc)}</div>
                `;
                projView.appendChild(div);
            });

            // Interests with Diamond Bullets
            const intList = document.getElementById('view-interests-list');
            intList.innerHTML = '';
            if (currentData.interests) {
                currentData.interests.split('\n').filter(l => l.trim()).forEach(line => {
                    const li = document.createElement('li');
                    li.textContent = '✦' + line.replace(/^[✦\*\-\+]\s*/, '');
                    intList.appendChild(li);
                });
            }

            // Achievements with Diamond Bullets
            const achList = document.getElementById('view-achievements-list');
            achList.innerHTML = '';
            if (currentData.achievements) {
                currentData.achievements.split('\n').filter(l => l.trim()).forEach(line => {
                    const li = document.createElement('li');
                    li.textContent = '✦' + line.replace(/^[✦\*\-\+]\s*/, '');
                    achList.appendChild(li);
                });
            }

            // Links
            const linksView = document.getElementById('view-links');
            let linksHtml = '';
            if (currentData.linkedin) {
                linksHtml += `<div>LINKEDIN- ${escapeHtml(currentData.linkedin)}</div>`;
            }
            if (currentData.github) {
                linksHtml += `<div>GITHUB- ${escapeHtml(currentData.github)}</div>`;
            }
            linksView.innerHTML = linksHtml;

            // Declaration
            document.getElementById('view-declaration').textContent = currentData.declaration || '';
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
                    currentData = JSON.parse(JSON.stringify(sampleData));
                }
            } else {
                currentData = JSON.parse(JSON.stringify(sampleData));
            }
            populateForm();
        }

        // Quick Fill Sample
        function loadSampleData() {
            currentData = JSON.parse(JSON.stringify(sampleData));
            populateForm();
            saveToStorage();
            showToast('Sample data loaded!');
        }

        // Clear All Fields
        function clearAllFields() {
            if (confirm('Are you sure you want to clear all fields to start blank?')) {
                currentData = {
                    name: "",
                    photo: "assets/placeholder-avatar.svg",
                    address: "",
                    email: "",
                    phone: "",
                    dob: "",
                    objective: "",
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
