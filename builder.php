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
        /* Builder Page Styles */
        body {
            background-color: var(--bg-dark);
            min-height: 100vh;
        }

        .builder-header {
            background: rgba(10, 10, 11, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--surface-border);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .builder-nav {
            max-width: 1200px;
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
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .edit-hint-bar {
            background: rgba(139, 92, 246, 0.12);
            border: 1px solid rgba(139, 92, 246, 0.3);
            color: #d8b4fe;
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            max-width: 850px;
            margin: 1.5rem auto 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        /* Resume Paper Canvas */
        .resume-wrapper {
            padding: 1.5rem 1rem 5rem 1rem;
            display: flex;
            justify-content: center;
        }

        .resume-sheet {
            background: #ffffff;
            color: #1a1a1a;
            width: 850px;
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
        }

        .classic-contact {
            text-align: right;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 13.5px;
            color: #222;
            line-height: 1.5;
            flex-shrink: 0;
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

        /* Links block */
        .links-entry {
            margin-bottom: 4px;
        }
        .links-entry:last-child {
            margin-bottom: 0;
        }

        /* Editable highlight effect */
        [contenteditable="true"] {
            outline: none;
            transition: background 0.15s ease, box-shadow 0.15s ease;
            border-radius: 2px;
        }
        [contenteditable="true"]:hover {
            background-color: rgba(224, 231, 255, 0.4);
        }
        [contenteditable="true"]:focus {
            background-color: rgba(224, 231, 255, 0.7);
            box-shadow: 0 0 0 2px #8b5cf6;
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

        /* Print Media Styles */
        @media print {
            body {
                background: white !important;
                color: black !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .builder-header,
            .edit-hint-bar,
            .bg-mesh,
            .toast,
            .photo-overlay {
                display: none !important;
            }
            .resume-wrapper {
                padding: 0 !important;
                margin: 0 !important;
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
            [contenteditable="true"]:hover,
            [contenteditable="true"]:focus {
                background: transparent !important;
                box-shadow: none !important;
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
            <div style="display: flex; align-items: center; gap: 1rem;">
                <a href="templates.php" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                    &larr; Back to Templates
                </a>
                <a href="index.php" class="logo" style="text-decoration: none; color: inherit;">
                    <span class="logo-icon"></span>
                    <span class="logo-text">Aura<span>CV</span></span>
                </a>
                <span class="badge" style="margin: 0; background: rgba(255,255,255,0.08); color: var(--text-main);">
                    Template: Classic Academic
                </span>
            </div>

            <div class="builder-actions">
                <input type="file" id="photo-file-input" accept="image/*" style="display: none;">
                <button type="button" class="btn btn-outline" onclick="document.getElementById('photo-file-input').click();">
                    📷 Change Photo
                </button>
                <button type="button" class="btn btn-outline" onclick="resetToSample();">
                    🔄 Reset Sample Data
                </button>
                <button type="button" class="btn btn-outline" onclick="saveToLocalStorage();">
                    💾 Save Draft
                </button>
                <button type="button" class="btn btn-primary" onclick="window.print();">
                    🖨️ Print / Export PDF
                </button>
            </div>
        </div>
    </header>

    <!-- Interactive Hint Bar -->
    <div class="edit-hint-bar">
        <span>💡 <b>Live Edit Mode:</b> Click on any text, heading, or bullet point directly to customize your resume. All changes persist automatically and are print-ready.</span>
        <button onclick="this.parentElement.style.display='none'" style="background:none; border:none; color:inherit; cursor:pointer; font-size:1.1rem;">&times;</button>
    </div>

    <!-- Resume Paper Canvas -->
    <main class="resume-wrapper">
        <article class="resume-sheet" id="resume-container">
            
            <!-- HEADER -->
            <header class="classic-header">
                <!-- Photo Box -->
                <div class="classic-photo-container" onclick="document.getElementById('photo-file-input').click();" title="Click to upload/change photo">
                    <img id="resume-photo" src="assets/placeholder-avatar.svg" alt="Candidate Photo">
                    <div class="photo-overlay">Change Photo</div>
                </div>

                <!-- Name & Address -->
                <div class="classic-identity">
                    <h1 class="classic-name" contenteditable="true" spellcheck="false" id="field-name">ALEXANDER J. MORGAN</h1>
                    <div class="classic-address" contenteditable="true" spellcheck="false" id="field-address">
                        7/234 Innovation Main Road,<br>
                        Cyber Valley Tech Park,<br>
                        Palayamkottai, Tirunelveli-627353
                    </div>
                </div>

                <!-- Right Contact Details -->
                <div class="classic-contact" contenteditable="true" spellcheck="false" id="field-contact">
                    alex.morgan2024@gmail.com<br>
                    +91 98765 43210<br>
                    DOB 14 / 07 / 2002
                </div>
            </header>

            <!-- 1. OBJECTIVE -->
            <section class="classic-row">
                <div class="classic-col-title" contenteditable="true" spellcheck="false">Objective</div>
                <div class="classic-col-content" contenteditable="true" spellcheck="false" id="field-objective">
                    To Secure a Strategic Role in a leading High-Tech Company where I can contribute to key initiatives through precise insight and dedicated execution, ensuring efficient achievement of project goals.
                </div>
            </section>

            <!-- 2. EDUCATION -->
            <section class="classic-row">
                <div class="classic-col-title" contenteditable="true" spellcheck="false">Education</div>
                <div class="classic-col-content" contenteditable="true" spellcheck="false" id="field-education">
                    <div class="edu-entry">
                        <div class="edu-school">Oakridge International Senior Secondary School</div>
                        <div class="edu-degree">SSLC - State Board</div>
                        <div class="edu-year">2021 — 95%</div>
                    </div>
                    <div class="edu-entry">
                        <div class="edu-school">St. Jude Higher Secondary School</div>
                        <div class="edu-degree">HSC - State Board</div>
                        <div class="edu-year">2023 — 88.67%</div>
                    </div>
                    <div class="edu-entry">
                        <div class="edu-school">National Institute of Science & Technology</div>
                        <div class="edu-degree">B.Sc. Computer Science</div>
                        <div class="edu-year">2023-2026 — 8.5 CGPA</div>
                    </div>
                    <div class="edu-entry">
                        <div class="edu-school">Metropolitan Engineering College</div>
                        <div class="edu-degree">MCA</div>
                        <div class="edu-year">Currently Pursuing — 2026-2028</div>
                    </div>
                </div>
            </section>

            <!-- 3. TECHNICAL SKILLS -->
            <section class="classic-row">
                <div class="classic-col-title" contenteditable="true" spellcheck="false">Technical<br>Skills</div>
                <div class="classic-col-content" contenteditable="true" spellcheck="false" id="field-skills">
                    <div>Python, Java, C++</div>
                    <div>AI-Assisted Full Stack Developer</div>
                    <div>Prompt Engineering For Development</div>
                </div>
            </section>

            <!-- 4. PROJECTS -->
            <section class="classic-row">
                <div class="classic-col-title" contenteditable="true" spellcheck="false">Projects</div>
                <div class="classic-col-content" contenteditable="true" spellcheck="false" id="field-projects">
                    <div class="project-entry">
                        <div class="project-heading">MEDICINE STORE MANAGEMENT SYSTEM</div>
                        <div class="project-tech"><b>Technologies Used:</b> HTML, CSS, JavaScript, PHP, MySQL.</div>
                        <div class="project-desc">Developed a web-based Medicine Store Management System to manage medicines, customer registrations, orders, billing, and inventory tracking.</div>
                    </div>
                    <div class="project-entry" style="margin-top: 14px;">
                        <div class="project-heading">DISEASE PREDICTION SYSTEM</div>
                        <div class="project-tech"><b>Technologies Used:</b> Python, Machine Learning, Flask, HTML, CSS, JavaScript.</div>
                        <div class="project-desc">Developed an intelligent web-based Disease Prediction System that predicts possible diseases based on user-entered symptoms.</div>
                    </div>
                </div>
            </section>

            <!-- 5. INTERESTS -->
            <section class="classic-row">
                <div class="classic-col-title" contenteditable="true" spellcheck="false">Interests</div>
                <div class="classic-col-content" contenteditable="true" spellcheck="false" id="field-interests">
                    <ul class="diamond-list">
                        <li>✦Python , Java , Html, CSS, Javascript, MYSQL, PHP, Dot Net</li>
                        <li>✦Website Designing, Animation (Figma)</li>
                        <li>✦MongoDB ,Express.js ,React.js , Node.js</li>
                    </ul>
                </div>
            </section>

            <!-- 6. ACHIEVEMENTS & AWARDS -->
            <section class="classic-row">
                <div class="classic-col-title" contenteditable="true" spellcheck="false">Achievements<br>& Awards</div>
                <div class="classic-col-content" contenteditable="true" spellcheck="false" id="field-achievements">
                    <ul class="diamond-list">
                        <li>✦Participate in Web Designing( Code Debugging)</li>
                        <li>✦Python Certification (NPTEL)</li>
                        <li>✦Internship (AI & ML, WEB DEVELOPMENT)</li>
                        <li>✦Internship (WEB DEVELOPING)</li>
                        <li>✦Foundation of Coding python by State Skill Program</li>
                        <li>✦English Language & Professional Communication Award</li>
                    </ul>
                </div>
            </section>

            <!-- 7. LINKS -->
            <section class="classic-row">
                <div class="classic-col-title" contenteditable="true" spellcheck="false">Links</div>
                <div class="classic-col-content" contenteditable="true" spellcheck="false" id="field-links">
                    <div class="links-entry">LINKEDIN- https://www.linkedin.com/in/alex-morgan-developer/</div>
                    <div class="links-entry">GITHUB- https://github.com/alex-morgan-dev</div>
                </div>
            </section>

            <!-- 8. DECLARATION -->
            <section class="classic-row">
                <div class="classic-col-title" contenteditable="true" spellcheck="false">Declaration</div>
                <div class="classic-col-content" contenteditable="true" spellcheck="false" id="field-declaration">
                    I hereby declare that above information is correct to the best of my knowledge and belief.
                </div>
            </section>

        </article>
    </main>

    <!-- Toast message -->
    <div class="toast" id="toast">Draft saved successfully!</div>

    <script>
        // Photo upload handler
        const photoInput = document.getElementById('photo-file-input');
        const resumePhoto = document.getElementById('resume-photo');

        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    resumePhoto.src = evt.target.result;
                    localStorage.setItem('auracv_classic_photo', evt.target.result);
                    showToast('Photo updated!');
                };
                reader.readAsDataURL(file);
            }
        });

        // Toast display
        function showToast(msg) {
            const toast = document.getElementById('toast');
            toast.textContent = msg;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }

        // Local Storage Draft Saving
        const fields = [
            'field-name', 'field-address', 'field-contact', 'field-objective',
            'field-education', 'field-skills', 'field-projects', 'field-interests',
            'field-achievements', 'field-links', 'field-declaration'
        ];

        function saveToLocalStorage() {
            fields.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    localStorage.setItem('auracv_' + id, el.innerHTML);
                }
            });
            showToast('Changes saved to draft!');
        }

        // Auto-save on blur
        fields.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('blur', () => {
                    localStorage.setItem('auracv_' + id, el.innerHTML);
                });
            }
        });

        // Load Draft
        function loadDraft() {
            fields.forEach(id => {
                const saved = localStorage.getItem('auracv_' + id);
                if (saved !== null) {
                    const el = document.getElementById(id);
                    if (el) el.innerHTML = saved;
                }
            });
            const savedPhoto = localStorage.getItem('auracv_classic_photo');
            if (savedPhoto) {
                resumePhoto.src = savedPhoto;
            }
        }

        // Reset to initial sample data
        const initialSampleData = {};
        window.addEventListener('DOMContentLoaded', () => {
            fields.forEach(id => {
                const el = document.getElementById(id);
                if (el) initialSampleData[id] = el.innerHTML;
            });
            // Try loading existing draft if user has edited before
            loadDraft();
        });

        function resetToSample() {
            if (confirm('Are you sure you want to reset to the example sample data?')) {
                fields.forEach(id => {
                    const el = document.getElementById(id);
                    if (el && initialSampleData[id]) {
                        el.innerHTML = initialSampleData[id];
                        localStorage.removeItem('auracv_' + id);
                    }
                });
                resumePhoto.src = 'assets/placeholder-avatar.svg';
                localStorage.removeItem('auracv_classic_photo');
                showToast('Reset to sample data.');
            }
        }
    </script>
</body>
</html>
