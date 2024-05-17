const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');

// Enable or Disable buttons if in last or first page

if (pageNumber <= 1) {
    prevButton.disabled = true;
    prevButton.classList.add('disabled');
}

if (pageNumber >= totalPages) {
    nextButton.disabled = true;
    nextButton.classList.add('disabled');
}