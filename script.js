/* ============================================================
   AuraCV — Client-Side Scripts (Zety Theme Interactivity)
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

    /* 1. Navbar Scroll Effect */
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    /* 2. Color Swatch Interactivity (Zety Image 1 & 5) */
    const swatchDots = document.querySelectorAll('.swatch-dot');
    swatchDots.forEach(dot => {
        dot.addEventListener('click', (e) => {
            e.stopPropagation();
            const parent = dot.closest('.color-swatches');
            if (!parent) return;

            // Mark active dot
            parent.querySelectorAll('.swatch-dot').forEach(d => d.classList.remove('active'));
            dot.classList.add('active');

            // Apply accent color border to the corresponding preview card
            const targetId = parent.getAttribute('data-target');
            if (targetId) {
                const previewEl = document.getElementById(targetId);
                const color = dot.getAttribute('data-color');
                if (previewEl) {
                    if (color === 'rainbow') {
                        previewEl.style.borderTop = '4px solid #f43f5e';
                    } else if (color) {
                        previewEl.style.borderTop = `4px solid ${color}`;
                    }
                }
            }
        });
    });

    /* 3. Template Selection & Sticky Action Bar (Zety Image 1 & 5) */
    const templateCards = document.querySelectorAll('.zety-template-card');
    const stickyBtn = document.getElementById('sticky-use-btn');

    templateCards.forEach(card => {
        card.addEventListener('click', () => {
            // Unselect all others in the same container
            const container = card.parentElement;
            if (container) {
                container.querySelectorAll('.zety-template-card').forEach(c => c.classList.remove('active'));
            }
            card.classList.add('active');

            // Update sticky button href if present
            const templateSlug = card.getAttribute('data-template') || 'classic';
            const mode = card.getAttribute('data-mode') || (typeof currentCategory !== 'undefined' && currentCategory === 'experienced' ? '2page' : '1page');
            if (stickyBtn) {
                stickyBtn.href = `builder.php?template=${templateSlug}&mode=${mode}`;
            }
        });
    });

    /* 4. Live Filter Sidebar on templates.php (Zety Image 5) */
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    const clearFiltersBtn = document.getElementById('clear-all-filters');
    const catalogCards = document.querySelectorAll('#templates-grid .zety-template-card');

    function applyCatalogFilters() {
        if (!catalogCards.length) return;

        const activeCat = typeof currentCategory !== 'undefined' ? currentCategory : 'student';
        const selectedHeadshot = Array.from(document.querySelectorAll('input[name="headshot"]:checked')).map(cb => cb.value);
        const selectedColumns = Array.from(document.querySelectorAll('input[name="columns"]:checked')).map(cb => cb.value);
        const selectedStyle = Array.from(document.querySelectorAll('input[name="style"]:checked')).map(cb => cb.value);

        catalogCards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (cardCat && cardCat !== activeCat) {
                card.style.display = 'none';
                return;
            }

            const cardHeadshot = card.getAttribute('data-headshot');
            const cardColumns = card.getAttribute('data-columns');
            const cardStyle = card.getAttribute('data-style');

            const matchHeadshot = selectedHeadshot.length === 0 || selectedHeadshot.includes(cardHeadshot);
            const matchColumns = selectedColumns.length === 0 || selectedColumns.includes(cardColumns);
            const matchStyle = selectedStyle.length === 0 || selectedStyle.includes(cardStyle);

            if (matchHeadshot && matchColumns && matchStyle) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    window.applyCatalogFilters = applyCatalogFilters;

    filterCheckboxes.forEach(cb => {
        cb.addEventListener('change', applyCatalogFilters);
    });

    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', () => {
            filterCheckboxes.forEach(cb => cb.checked = true);
            applyCatalogFilters();
        });
    }

    /* 5. Student Onboarding Wizard Modal (Zety Image 4) */
    const wizardModal = document.getElementById('student-wizard-modal');
    const openWizardBtns = document.querySelectorAll('.open-wizard-btn');
    const closeWizardBtn = document.getElementById('close-wizard-modal');

    if (wizardModal) {
        openWizardBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                wizardModal.classList.add('active');
            });
        });

        if (closeWizardBtn) {
            closeWizardBtn.addEventListener('click', () => {
                wizardModal.classList.remove('active');
            });
        }

        wizardModal.addEventListener('click', (e) => {
            if (e.target === wizardModal) {
                wizardModal.classList.remove('active');
            }
        });

        // Student Yes/No toggle pills
        const btnStudentYes = document.getElementById('btn-student-yes');
        const btnStudentNo = document.getElementById('btn-student-no');

        if (btnStudentYes && btnStudentNo) {
            btnStudentYes.addEventListener('click', () => {
                btnStudentYes.classList.add('active');
                btnStudentNo.classList.remove('active');
            });
            btnStudentNo.addEventListener('click', () => {
                btnStudentNo.classList.add('active');
                btnStudentYes.classList.remove('active');
            });
        }

        // Education level options click
        const eduCards = document.querySelectorAll('.edu-level-card');
        eduCards.forEach(card => {
            card.addEventListener('click', () => {
                eduCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                const level = card.getAttribute('data-level') || 'bachelors';
                setTimeout(() => {
                    window.location.href = `builder.php?template=classic&education=${level}`;
                }, 200);
            });
        });
    }

});
