var nav = document.querySelector('.nav');
var deliveryBanner = document.querySelector('.delivery-banner');

window.addEventListener('scroll', function() {
    // Check if the user has scrolled beyond the top of the page
    if (window.scrollY > 0) {
        nav.style.top = '0';
       
        // Hide the delivery banner
        deliveryBanner.style.display = 'none';
        deliveryBanner.style.marginBottom ='0';
    } else {
        // Show the delivery banner
        deliveryBanner.style.display = 'grid';

        nav.style.top = '4em';
    }
});

// window.addEventListener('resize', function() {  
//     if (window.innerWidth <= 800) {
//       if (nav.style.top == '2em') {
//         nav.style.top = '1em';
//       }     
//     }
//   });