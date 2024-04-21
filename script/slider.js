const slides = document.querySelectorAll(".img-container");
const slideImages = document.querySelectorAll(".slide");
const prev = document.getElementById("prev-button");
const next = document.getElementById("next-button");
var counter = 0;
var nSlides = slides.length - 1;


console.log(slides);
console.log(nSlides);

// Position All Images

slides.forEach( (slide, index) => {
    slide.style.left = `${index * 100}%`;
})

// Scale All Images

slides.forEach  ( (slide) => {
    var image = slide.querySelector('.slide');
    if ((image.naturalWidth / image.naturalHeight) > 1) {
        image.style.width = '100%';
        image.style.height = 'auto';
    } else {
        image.style.width = 'auto';
        image.style.height = '100%';
    }
})

// Move All Images

function moveSlides(n) {
    if ((counter + n) < 0) {
        counter = nSlides;
    } else if ((counter + n) > nSlides) {
        counter = 0;
    } else {
        counter += n;
    }
    slides.forEach( (slide, index) => {
        slide.style.transform = `translateX(-${counter * 100}%)`;
    })
}





