<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experience Level - AuraCV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=6">
</head>
<body class="exp-page">

    <!-- Navbar: Clean Dark Header with Logo (Matching Image 1) -->
    <header class="exp-navbar">
        <a href="index.php" class="logo" style="text-decoration:none;">
            <span class="logo-badge"></span>
            <span style="color:#ffffff;">aura</span><span style="color:var(--blue);">cv</span>
        </a>
    </header>

    <!-- Main Question Box -->
    <main class="exp-main">

        <!-- Question 1: How long have you been working? -->
        <div class="exp-title-box">
            <h1 class="exp-title">
                How long have you been working?
                <span class="info-circle" title="This helps us select the right templates and layout for you">i</span>
            </h1>
            <p class="exp-subtitle">We'll find the best templates for your experience level.</p>
        </div>

        <!-- 5 Experience Options Grid (Matching Image 1 & 2) -->
        <div class="exp-options-grid">
            <div class="exp-card" data-exp="no-experience" id="opt-no-exp">No Experience</div>
            <div class="exp-card" data-exp="less-than-3" id="opt-less-3">Less Than 3 Years</div>
            <div class="exp-card" data-exp="3-5" id="opt-3-5">3-5 Years</div>
            <div class="exp-card" data-exp="5-10" id="opt-5-10">5-10 Years</div>
            <div class="exp-card" data-exp="10-plus" id="opt-10-plus">10+ Years</div>
        </div>

        <!-- Question 2: Are you a student? (Revealed when No Experience or Less Than 3 Years is clicked — Image 2) -->
        <div class="exp-student-section" id="student-question-section">
            <h2 class="exp-student-title">Are you a student?</h2>
            <div class="exp-student-btns">
                <button type="button" class="exp-student-btn" id="btn-student-yes">Yes</button>
                <button type="button" class="exp-student-btn" id="btn-student-no">No</button>
            </div>
        </div>

        <!-- Question 3: What education level are you currently pursuing? (Revealed when Yes is clicked — Uploaded Screenshot) -->
        <div class="exp-education-section" id="education-question-section">
            <h2 class="exp-education-title">What education level are you currently pursuing?</h2>
            <p class="exp-education-desc">Select the highest level you are working toward so we can organize your resume correctly.</p>

            <div class="exp-education-grid">
                <div class="exp-edu-card" data-edu="secondary">Secondary School</div>
                <div class="exp-edu-card" data-edu="diploma">Vocational Certificate or Diploma</div>
                <div class="exp-edu-card" data-edu="internship">Apprenticeship or Internship Training</div>
                <div class="exp-edu-card" data-edu="associates">Associates</div>
                <div class="exp-edu-card" data-edu="bachelors">Bachelors</div>
                <div class="exp-edu-card" data-edu="masters">Masters</div>
                <div class="exp-edu-card span-center" data-edu="phd">Doctorate or Ph.D.</div>
            </div>
        </div>

    </main>

    <!-- Footer: Clean Legal Links (Matching Image 1) -->
    <footer class="exp-footer">
        <div class="exp-footer-links">
            <a href="#">TERMS AND CONDITIONS</a>
            <a href="#">PRIVACY POLICY</a>
            <a href="#">ACCESSIBILITY</a>
            <a href="#">CONTACT US</a>
        </div>
        <div>
            &copy; 2026, AuraCV Limited. All rights reserved.
        </div>
    </footer>

    <!-- Interactive Logic Script -->
    <script>
        const expCards = document.querySelectorAll('.exp-card');
        const studentSection = document.getElementById('student-question-section');
        const educationSection = document.getElementById('education-question-section');
        const btnStudentYes = document.getElementById('btn-student-yes');
        const btnStudentNo = document.getElementById('btn-student-no');
        const eduCards = document.querySelectorAll('.exp-edu-card');

        let selectedExperience = null;

        // Step 1: How long have you been working?
        expCards.forEach(card => {
            card.addEventListener('click', () => {
                expCards.forEach(c => c.classList.remove('active'));
                card.classList.add('active');

                selectedExperience = card.getAttribute('data-exp');

                // If user selected "No Experience" or "Less Than 3 Years" -> show "Are you a student?"
                if (selectedExperience === 'no-experience' || selectedExperience === 'less-than-3') {
                    studentSection.classList.add('visible');
                    setTimeout(() => {
                        studentSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }, 100);
                } else {
                    // For 3-5 Years, 5-10 Years, 10+ Years -> Go directly to templates page!
                    studentSection.classList.remove('visible');
                    educationSection.classList.remove('visible');
                    setTimeout(() => {
                        window.location.href = `templates.php?exp=experienced&years=${encodeURIComponent(selectedExperience)}`;
                    }, 250);
                }
            });
        });

        // Step 2: "Are you a student?"
        // Click YES -> Reveal "What education level are you currently pursuing?" (Uploaded Screenshot)
        btnStudentYes.addEventListener('click', () => {
            btnStudentYes.classList.add('active');
            btnStudentNo.classList.remove('active');

            educationSection.classList.add('visible');
            setTimeout(() => {
                educationSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        });

        // Click NO -> Go directly to templates page for entry-level non-student
        btnStudentNo.addEventListener('click', () => {
            btnStudentNo.classList.add('active');
            btnStudentYes.classList.remove('active');
            educationSection.classList.remove('visible');

            setTimeout(() => {
                window.location.href = `templates.php?exp=entry&student=no&years=${encodeURIComponent(selectedExperience || 'less-than-3')}`;
            }, 250);
        });

        // Step 3: Education Level Clicked -> Go directly to templates page with education level!
        eduCards.forEach(eduCard => {
            eduCard.addEventListener('click', () => {
                eduCards.forEach(c => c.classList.remove('active'));
                eduCard.classList.add('active');

                const chosenEdu = eduCard.getAttribute('data-edu') || 'bachelors';
                setTimeout(() => {
                    window.location.href = `templates.php?exp=entry&student=yes&education=${encodeURIComponent(chosenEdu)}&years=${encodeURIComponent(selectedExperience || 'less-than-3')}`;
                }, 250);
            });
        });
    </script>
</body>
</html>
