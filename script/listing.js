const checkbox = document.getElementById('cellphone-checkbox');
const cellphoneWrapper = document.getElementById('cellphone-wrapper');
const fileInput = document.getElementById('fileInput');

function toggleContent() {
    if (checkbox.checked) {
        cellphoneWrapper.style.display = 'block';
    } else {
        cellphoneWrapper.style.display = 'none';
    }
};

toggleContent();

fileInput.addEventListener('change', (e) => {
    if(window.File && window.FileReader && window.FileList && window.Blob) {
        const files = e.target.files;
        const output = document.getElementById('display-images');
        output.innerHTML="";
        console.log(files);

        for(i = 0 ; i < files.length; i++) {
            const fileReader = new FileReader();
            fileReader.addEventListener('load', function(event) {
                const image = event.target;
                const div = document.createElement('div');
                div.innerHTML = `<img class="image-thumbnail" src="${image.result}" title="${image.name}"/>`;
                output.appendChild(div);
            })
            fileReader.readAsDataURL(files[i]);
        }
    }
})

checkbox.addEventListener('change', toggleContent);

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
                    attributeName.innerHTML = attribute.name;
                    if (attribute.data_type === 'text') {
                        inputField = document.createElement('input');
                        inputField.setAttribute('type', 'text');
                    } else if (attribute.data_type === 'number') {
                        inputField = document.createElement('input');
                        inputField.setAttribute('type', 'number');
                    } else if (attribute.data_type === 'boolean') {
                        inputField = document.createElement('input');
                        inputField.setAttribute('type', 'checkbox');
                    }
                    inputField.setAttribute('name', 'attribute_' + attribute.attribute_id);
                    wrapper.appendChild(attributeName);
                    wrapper.appendChild(inputField);
                    inputField.classList.add('small-text')
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

document.getElementById('category').value = 9;