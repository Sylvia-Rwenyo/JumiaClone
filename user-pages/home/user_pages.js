// Wait for the document to fully load
document.addEventListener("DOMContentLoaded", function() {
    // Hide the preloader once the document is loaded
    document.getElementById("preloader").style.display = "none";
  const lazyImages = document.querySelectorAll("img[data-src]");

  // IntersectionObserver to lazy load images
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.removeAttribute("data-src");
        observer.unobserve(img);
      }
    });
  });

  // Observe each lazy image
  lazyImages.forEach(image => {
    observer.observe(image);
  });
});
