// js/main.js
document.addEventListener('DOMContentLoaded', function () {

    document.body.classList.add('dark-mode');
    localStorage.removeItem('theme');

    if (typeof window.updateWeatherChartTheme === 'function') {
        window.updateWeatherChartTheme();
    }
    

    //hamburger menu//
    const menuBtn = document.getElementById('menu-btn');
    const navbar = document.getElementById('navbar');
    if (menuBtn && navbar) {
        menuBtn.addEventListener('click', function () {
            navbar.classList.toggle('active');
        });
        
        //open and close drop menu
        const navLinks = navbar.querySelectorAll('a');
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                navbar.classList.remove('active');
            });
        });
    }
    

    //jQuery animations for 
    if (window.jQuery) {
        
        //homepage animation - fade hero area 
        if ($('.home-hero-inner').length) {
            $('.home-hero-inner')
                .css({ opacity: 0 })
                .animate({ opacity: 1 }, 1000, 'swing');
        }

        //homepage card aniamtion
        if ($('.component-card').length) {
            $('.component-card').css({
                opacity: 0,
                position: 'relative',
                top: '20px'
            });
            $('.component-card').each(function (index) {
                $(this).delay(200 * index).animate(
                    { opacity: 1, top: 0 },
                    800,
                    'swing'
                );
            });
        }

        //show/hide button animation
        $('#toggle-tech').on('click', function () {
            $('#tech-details').slideToggle('slow');
        });
        
        //cv page hero area animation
        if ($('.cv-hero').length) {
            $('.cv-hero')
                .css({ opacity: 0, position: 'relative', top: '20px' })
                .animate({ opacity: 1, top: 0 }, 800, 'swing');
        }

        //cv page cards animation
        if ($('.cv-card').length) {
            $('.cv-card').css({
                opacity: 0,
                position: 'relative',
                top: '20px'
            });
            $('.cv-card').each(function (index) {
                $(this).delay(200 * index).animate(
                    { opacity: 1, top: 0 },
                    800,
                    'swing'
                );
            });
        }
    }
});

