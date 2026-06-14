// ===== MODERN HERO BANNER INTERACTIONS =====

document.addEventListener('DOMContentLoaded', function() {
    
    // Modal Elements
    const modal = document.getElementById('authModal');
    const modalTriggers = document.querySelectorAll('.open-modal-trigger');
    const closeModalBtn = document.getElementById('closeAuthModal');
    const modalBackdrop = modal?.querySelector('.custom-modal-backdrop');
    
    // Open Modal
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    });
    
    // Close Modal
    closeModalBtn?.addEventListener('click', closeModal);
    modalBackdrop?.addEventListener('click', closeModal);
    
    // ESC key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal?.classList.contains('active')) {
            closeModal();
        }
    });
    
    function openModal() {
        modal?.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        modal?.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    // Parallax Effect on Images
    const heroImages = document.querySelectorAll('.hero-image-card');
    
    window.addEventListener('mousemove', function(e) {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        heroImages.forEach((img, index) => {
            const speed = (index + 1) * 10;
            const x = (mouseX - 0.5) * speed;
            const y = (mouseY - 0.5) * speed;
            
            img.style.transform = `translate(${x}px, ${y}px)`;
        });
    });
    
});


// ABOUT SECTION
document.addEventListener('DOMContentLoaded', function() {
    const aboutContent = document.querySelector('.about-content');
    const aboutImg = document.querySelector('.about-img');
    
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);
    
    if (aboutContent) observer.observe(aboutContent);
    if (aboutImg) observer.observe(aboutImg);
});

// TOP PRODUCTS SECTION _ Scroll animations
document.addEventListener('DOMContentLoaded', function() {
    const sellerItems = document.querySelectorAll('.topSellers ul li');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 50);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    sellerItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        item.style.transition = 'all 0.5s ease';
        observer.observe(item);
    });
});

// FAQ SECTION _FAQ smooth scroll and auto-collapse on mobile
document.addEventListener('DOMContentLoaded', function() {
    const faqButtons = document.querySelectorAll('.faq .accordion-button');
    
    faqButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Close other accordions on mobile
            if (window.innerWidth < 992) {
                const targetId = this.getAttribute('data-bs-target');
                const allCollapses = document.querySelectorAll('.faq .accordion-collapse');
                
                allCollapses.forEach(collapse => {
                    if (collapse.id !== targetId.replace('#', '')) {
                        const bsCollapse = new bootstrap.Collapse(collapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
            }
        });
    });
    
    // Smooth scroll to FAQ section
    const faqLinks = document.querySelectorAll('a[href*="#faq"]');
    faqLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const faqSection = document.querySelector('.faq');
            if (faqSection) {
                faqSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

/* ===== POPULAR COMPANY SECTION - SLIDER JS ===== */

(function ($) {
    'use strict';

    // Initialize slider when DOM is fully loaded
    $(document).ready(function () {
        initializePopularSlider();
    });

    // Also try on window load as fallback
    $(window).on('load', function () {
        if (!$('.popular-slider-wrapper').hasClass('slick-initialized')) {
            initializePopularSlider();
        }
    });

    function initializePopularSlider() {
        // Check if jQuery is loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded!');
            return;
        }

        // Check if Slick is loaded
        if (typeof $.fn.slick === 'undefined') {
            console.error('Slick slider is not loaded!');
            return;
        }

        // Check if slider element exists
        var $slider = $('.popular-slider-wrapper');
        if ($slider.length === 0) {
            console.warn('Popular slider element not found');
            return;
        }

        // Check if slider already initialized
        if ($slider.hasClass('slick-initialized')) {
            
            return;
        }

        // Check if slider has slides
        if ($slider.find('.creator-item').length === 0) {
            console.warn('No slides found in popular slider');
            return;
        }

        try {
            // Initialize Slick Slider
            $slider.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                dots: true,
                infinite: true,
                speed: 500,
                pauseOnHover: true,
                pauseOnFocus: true,
                pauseOnDotsHover: false,
                draggable: true,
                swipe: true,
                touchMove: true,
                accessibility: true,
                adaptiveHeight: false, // ← IMPORTANT: false = equal heights
                centerMode: false,
                variableWidth: false,

                // Responsive breakpoints
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: true,
                            dots: true,
                            centerMode: false
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: true,
                            dots: true,
                            centerMode: false
                        }
                    }
                ]
            });

            

            // After init: force equal height on all cards
            equalizeCardHeights($slider);

            // Event handlers
            $slider.on('init', function (event, slick) {
                
                equalizeCardHeights($slider);
            });

            $slider.on('afterChange', function (event, slick, currentSlide) {
                // Optional: log current slide
            });

            $slider.on('breakpoint', function (event, slick, breakpoint) {
                
                // Re-equalize on breakpoint change
                setTimeout(function () {
                    equalizeCardHeights($slider);
                }, 100);
            });

        } catch (error) {
            console.error('Error initializing popular slider:', error);

            // Fallback: Show slides in grid if slider fails
            $slider.addClass('slider-error-fallback');
            $slider.css({
                'display': 'flex',
                'flex-wrap': 'wrap',
                'gap': '20px'
            });
        }
    }

    /**
     * equalizeCardHeights
     * Forces all .creator-link cards to be the same height
     * so no card looks taller or shorter than others
     */
    function equalizeCardHeights($slider) {
        // Reset heights first
        $slider.find('.creator-link').css('height', '');
        $slider.find('.creator-info').css('min-height', '');

        var maxHeight = 0;

        // Find tallest card
        $slider.find('.creator-link').each(function () {
            var h = $(this).outerHeight();
            if (h > maxHeight) maxHeight = h;
        });

        // Apply to all cards
        if (maxHeight > 0) {
            $slider.find('.creator-link').css('height', maxHeight + 'px');
        }
    }

    // Reinitialize slider on window resize (debounced)
    var resizeTimer;
    $(window).on('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            var $slider = $('.popular-slider-wrapper');
            if ($slider.hasClass('slick-initialized')) {
                // Reset heights before recalculating
                $slider.find('.creator-link').css('height', '');
                $slider.slick('setPosition');
                setTimeout(function () {
                    equalizeCardHeights($slider);
                }, 150);
            }
        }, 250);
    });

})(jQuery);

/* ===== END POPULAR COMPANY SLIDER ===== */


