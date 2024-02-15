document.addEventListener("DOMContentLoaded", function () {
    const deliveryCarousel = document.querySelector(".delivery-carousel");

    function moveCarousel() {
        const firstItem = deliveryCarousel.children[0];
        deliveryCarousel.style.transition = "transform 0.5s ease-in-out";
        deliveryCarousel.style.transform = "translateY(" + -firstItem.offsetHeight + "px)";
        setTimeout(() => {
            deliveryCarousel.appendChild(firstItem);
            deliveryCarousel.style.transition = "none";
            deliveryCarousel.style.transform = "translateY(0)";
        }, 500);
    }

    setInterval(moveCarousel, 3000); // Change slide every 3 seconds
});