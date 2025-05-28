document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.main-nav-links');
    const body = document.body;

    function closeMenu() {
        hamburger.classList.remove('is-active');
        navLinks.classList.remove('is-open');
        body.classList.remove('menu-open');
        
    }

    
    hamburger.addEventListener('click', function() {
        if (navLinks.classList.contains('is-open')) {
            closeMenu(); 
        } else {
            hamburger.classList.add('is-active');
            navLinks.classList.add('is-open');
            body.classList.add('menu-open');
           
        }
    });

    const menuLinks = navLinks.querySelectorAll('a');

    menuLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            
            if (navLinks.classList.contains('is-open')) {
                                         
                closeMenu(); 
                
            }
        });
    });
   
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992 && navLinks.classList.contains('is-open')) {
            closeMenu();
        }
    });
});