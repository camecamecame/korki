let index = 0;

const slider = document.querySelector(".slides");
const slides = document.querySelectorAll(".slide");

function showSlide() {
    slider.style.transform = `translateX(-${index * 100}%)`;
}

setInterval(() => {
    index++;

    if (index >= slides.length) {
        index = 0;
    }

    showSlide();
}, 3000);