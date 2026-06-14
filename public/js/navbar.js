document.addEventListener('DOMContentLoaded', function () {

    var burger    = document.getElementById('burgerBtn');
    var mobileNav = document.getElementById('mobileNav');

    if (burger && mobileNav) {
        burger.addEventListener('click', function () {
            burger.classList.toggle('open');
            mobileNav.classList.toggle('open');
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!burger.contains(e.target) && !mobileNav.contains(e.target)) {
                burger.classList.remove('open');
                mobileNav.classList.remove('open');
            }
        });
    }

    // EXCHANGE modal for guests
    var modal   = document.getElementById('authModal');
    var closeBtn = document.getElementById('closeAuthModal');

    if (modal) {
        document.querySelectorAll('.open-modal').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        modal.querySelector('.custom-modal-backdrop').addEventListener('click', function () {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

});
