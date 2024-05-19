
const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');

    // Enable or Disable buttons if in last or first page
if (prevButton != null) {
    if (pageNumber <= 1) {
        prevButton.disabled = true;
        prevButton.classList.add('disabled');
    }

    if (pageNumber >= totalPages) {
        nextButton.disabled = true;
        nextButton.classList.add('disabled');
    }
}

function fetchAttributes(category) {
    let request = new XMLHttpRequest();
    request.open('GET', '../php/fetch_attributes.php?category=' + encodeURIComponent(category), true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                let attributes = JSON.parse(this.responseText);
                let wrapper = document.getElementById('attributes');
                wrapper.innerHTML = '';
            
                attributes.forEach(function(attribute) {
                    let inputField;
                    let attributeName = document.createElement('h3');
                    if (attribute.data_type === 'text') {
                        inputField = document.createElement('input');
                        attributeName.innerHTML = attribute.name;
                        inputField.setAttribute('type', 'text');
                    } else if (attribute.data_type === 'number') {
                        attributeName.innerHTML = attribute.name;
                        inputField = document.createElement('input');
                        inputField.setAttribute('type', 'number');
                    } else if (attribute.data_type === 'boolean') {
                        attributeName.innerHTML = attribute.name;
                        inputField = document.createElement('input');
                        inputField.setAttribute('type', 'checkbox');
                    }
                    inputField.setAttribute('name', 'attribute_' + attribute.attribute_id);
                    wrapper.appendChild(attributeName);
                    wrapper.appendChild(inputField);
                    inputField.classList.add('filter-input')
                });
            } else {
                console.error('Error fetching attributes:', request.status);
            }
        }
    };
    request.send();
}

document.getElementById('category').addEventListener('change', function() {
    let selectedCategory = this.value;
    fetchAttributes(selectedCategory);
});

document.getElementById('category').value = '';

document.getElementById('condition').value = '';