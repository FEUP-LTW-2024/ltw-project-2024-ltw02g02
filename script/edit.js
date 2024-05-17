const passwordInput = document.getElementById('passwordEdit');
const confirmPassword = document.getElementById('confirmPassword');

passwordInput.addEventListener('input', function(event) {
    var inputValue = event.target.value;
    if (inputValue != '') {
        confirmPassword.style.display = 'block';
    } else {
        confirmPassword.style.display = 'none';
    }
})

function openPFP() {
    uploadPFP.style.display = 'block';
}

function closePFP() {
    uploadPFP.style.display = 'none';
}