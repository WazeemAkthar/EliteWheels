// carousel.js

let currentSlide = 0;
let slideInterval;

// Show the current slide based on the index
function showSlide(index) {
    const slides = document.querySelectorAll('.carousel-image');
    const totalSlides = slides.length;

    // Wrap around if index is out of bounds
    if (index >= totalSlides) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = totalSlides - 1;
    } else {
        currentSlide = index;
    }

    // Update carousel position to show one image at a time
    const carouselImages = document.querySelector('.carousel-images');
    carouselImages.style.transform = `translateX(-${currentSlide * 100}%)`;
}

// Move to the next slide
function nextSlide() {
    showSlide(currentSlide + 1);
}

// Move to the previous slide
function prevSlide() {
    showSlide(currentSlide - 1);
}

// Start the auto-slide functionality
function startAutoSlide() {
    slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
}

// Stop the auto-slide when user interacts with buttons
function stopAutoSlide() {
    clearInterval(slideInterval);
}

// Event listeners to stop the auto-slide when buttons are clicked
document.querySelector('.prev-btn').addEventListener('click', stopAutoSlide);
document.querySelector('.next-btn').addEventListener('click', stopAutoSlide);

// Initialize carousel and auto-slide
document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentSlide);
    startAutoSlide();
});
