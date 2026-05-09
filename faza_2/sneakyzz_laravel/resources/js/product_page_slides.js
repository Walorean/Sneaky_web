let current = 0;
const images = window.productImages || [];

document.addEventListener('DOMContentLoaded', () => {
    if (images.length === 0) return;

    const dotsContainer = document.getElementById('product-dots');
    if (dotsContainer) {
        images.forEach((_, i) => {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if (i === 0) dot.classList.add('active_dot');
            dotsContainer.appendChild(dot);
        });
    }

    updateProductSlide();
});

function updateProductSlide() {
    const photo = document.getElementById('product-photo');
    if (photo) photo.src = images[current];

    document.querySelectorAll('#product-dots .dot').forEach((dot, i) => {
        dot.classList.toggle('active_dot', i === current);
    });
}

function changeProductSlide(direction) {
    current = (current + direction + images.length) % images.length;
    updateProductSlide();
}

window.changeProductSlide = changeProductSlide;
