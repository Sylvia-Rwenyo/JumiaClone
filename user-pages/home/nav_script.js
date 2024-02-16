window.addEventListener('scroll', function() {
    var nav = document.querySelector('.nav');
    var deliveryBanner = document.querySelector('.delivery-banner');

    // Check if the user has scrolled beyond the top of the page
    if (window.scrollY > 0) {
        nav.style.top = '0';
        // Hide the delivery banner
        deliveryBanner.style.display = 'none';
    } else {
        // Show the delivery banner
        deliveryBanner.style.display = 'grid';
        nav.style.top = '3em';
    }
});