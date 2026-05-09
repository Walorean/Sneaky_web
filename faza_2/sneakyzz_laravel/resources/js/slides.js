let current = 0;

document.addEventListener('DOMContentLoaded', () => {
    updateSlide();
});

function updateSlide() {
    const images = window.sliderImages;
    const hero = document.getElementById('hero-ad');
    hero.style.backgroundImage = `linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('${images[current]}')`;

    document.querySelectorAll('.dot').forEach((dot, i) => {
        dot.classList.toggle('active_dot', i === current);
    });
}

function changeSlide(direction) {
    const images = window.sliderImages;
    current = (current + direction + images.length) % images.length;
    updateSlide();
}

window.changeSlide = changeSlide;
