var nav = document.querySelector('.nav');
var cart = document.querySelector('.cart');
var deliveryBanner = document.querySelector('.delivery-banner');

window.addEventListener('scroll', function() {
    // Check if the user has scrolled beyond the top of the page
    if (window.scrollY > 0) {
        nav.style.top = '0';
        nav.style.height = '4em';
        nav.style.paddingBottom = '1em';
        cart.style.marginTop = '1.5em';
       
        // Hide the delivery banner
        deliveryBanner.style.display = 'none';
        deliveryBanner.style.marginBottom ='0';
    } else {
        // Show the delivery banner
        deliveryBanner.style.display = 'grid';
        // deliveryBanner.style.marginBottom ='2em';
        nav.style.top = '2em';
        nav.style.height = '6em';
        cart.style.marginTop = '3.5em';
    }
});

// window.addEventListener('resize', function() {  
//     if (window.innerWidth <= 800) {
//       if (nav.style.top == '2em') {
//         nav.style.top = '1em';
//       }     
//     }
//   });