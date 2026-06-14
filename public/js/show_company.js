// ===== SHOW COMPANY PAGE - PAGE-SPECIFIC JS =====

$(document).ready(function () {

    // ── Last Added Products Slider ──
    if ($('.lastAdded.slider').length && typeof $.fn.slick !== 'undefined') {
        $('.lastAdded.slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 400,
            autoplay: true,
            autoplaySpeed: 3000,
            slidesToShow: 4,
            slidesToScroll: 1,
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
                        arrows: false,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: true
                    }
                }
            ]
        });
    }

});

// ===== END SHOW COMPANY PAGE JS =====
