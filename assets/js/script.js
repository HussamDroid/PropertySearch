
// Example: Form validation for submitting reviews
document.addEventListener('DOMContentLoaded', function () {
    const reviewForm = document.querySelector('form');
    
    reviewForm.addEventListener('submit', function(event) {
        const title = document.querySelector('input[name="title"]').value;
        const content = document.querySelector('textarea[name="content"]').value;
        const score = document.querySelector('input[name="score"]').value;

        // Basic validation
        if (title === '' || content === '' || score === '') {
            alert('Please fill in all fields.');
            event.preventDefault();
        } else if (score < 1 || score > 10) {
            alert('Please enter a score between 1 and 10.');
            event.preventDefault();
        }
    });
});

// Example: Image Slider for Property Images (if you want to add image slider later)
function initializeImageSlider() {
    const images = document.querySelectorAll('.property-images img');
    let currentIndex = 0;

    function showNextImage() {
        images[currentIndex].style.display = 'none'; // Hide the current image
        currentIndex = (currentIndex + 1) % images.length; // Move to the next image
        images[currentIndex].style.display = 'block'; // Show the next image
    }

    setInterval(showNextImage, 3000); // Change image every 3 seconds
}