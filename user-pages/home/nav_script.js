var nav = document.querySelector('.nav');
var deliveryBanner = document.querySelector('.delivery-banner');

window.addEventListener('scroll', function() {
    // Check if the user has scrolled beyond the top of the page
    if (window.scrollY > 0) {
        nav.style.top = '0';
        nav.style.height = '7em';
        nav.style.paddingBottom = '1em';
       ;
        // Hide the delivery banner
        deliveryBanner.style.display = 'none';
    } else {
        // Show the delivery banner
        deliveryBanner.style.display = 'grid';
        nav.style.top = '2em';
        nav.style.height = '6em';
        nav.style.paddingBottom = '0'
    }
});

// window.addEventListener('resize', function() {  
//     if (window.innerWidth <= 800) {
//       if (nav.style.top == '2em') {
//         nav.style.top = '1em';
//       }     
//     }
//   });