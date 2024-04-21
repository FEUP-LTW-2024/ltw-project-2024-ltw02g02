// Função para exibir pop-up
function showErrorPopup(message) {
    alert(message);
}

// Verifica se há mensagem de erro na URL
const urlParams = new URLSearchParams(window.location.search);
const errorMessage = urlParams.get('error');
if (errorMessage) {
    showErrorPopup(errorMessage);
}