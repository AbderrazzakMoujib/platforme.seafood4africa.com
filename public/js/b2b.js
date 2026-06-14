// ===== B2B PAGE - PAGE-SPECIFIC JS =====

document.addEventListener('DOMContentLoaded', function () {

    // ── Animate company cards on scroll (IntersectionObserver) ──
    const cards = document.querySelectorAll('.creators');

    if (cards.length === 0) return;

    const observerOptions = {
        threshold: 0.08,
        rootMargin: '0px 0px -40px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Staggered delay: each card appears slightly after the previous
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 70);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    cards.forEach(card => {
        // Initial hidden state (CSS also sets this, JS is backup)
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(card);
    });

    // ── Equalize card heights in each row ──
    // Runs once on load and again on resize
    function equalizeCardHeights() {
        // Group cards by row using their top offset
        const rows = {};

        cards.forEach(card => {
            const col = card.closest('[class*="col-"]');
            if (!col) return;
            // Reset height first
            card.style.minHeight = '';
            const top = col.getBoundingClientRect().top + window.scrollY;
            const rowKey = Math.round(top / 5) * 5; // group by ~5px tolerance
            if (!rows[rowKey]) rows[rowKey] = [];
            rows[rowKey].push(card);
        });

        // Apply max height per row
        Object.values(rows).forEach(rowCards => {
            let maxH = 0;
            rowCards.forEach(card => {
                const h = card.offsetHeight;
                if (h > maxH) maxH = h;
            });
            if (maxH > 0) {
                rowCards.forEach(card => {
                    card.style.minHeight = maxH + 'px';
                });
            }
        });
    }

    // Run on load
    equalizeCardHeights();

    // Run on resize (debounced)
    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(equalizeCardHeights, 200);
    });

});

// ===== END B2B PAGE JS =====