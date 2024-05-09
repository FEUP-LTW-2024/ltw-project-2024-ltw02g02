// Verifica se há mensagem de erro na URL
const urlParams = new URLSearchParams(window.location.search);
const errorMessage = urlParams.get('error');
if (errorMessage) {
    alert(errorMessage);
}