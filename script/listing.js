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