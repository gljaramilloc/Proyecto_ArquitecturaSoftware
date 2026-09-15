// Initializes the hero carousel on the home page.
// Bootstrap already auto-initializes carousels with data-bs-ride="carousel",
// but we keep this explicit setup so pause-on-hover and cycling stay
// consistent with the original design.
document.addEventListener('DOMContentLoaded', function () {
    var heroCarousel = document.querySelector('#heroCarousel');

    if (typeof bootstrap !== 'undefined' && heroCarousel) {
        var carousel = new bootstrap.Carousel(heroCarousel, {
            interval: 4000,
            ride: 'carousel',
            pause: 'hover',
        });

        carousel.cycle();
    }
});