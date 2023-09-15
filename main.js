// Função para exibir o popup
function exibirPopup() {
    // Obtém o elemento do popup
    var popup = document.getElementById("popup");

    // Exibe o popup
    popup.style.display = "block";
}

// Função para fechar o popup
function fecharPopup() {
    // Obtém o elemento do popup
    var popup = document.getElementById("popup");

    // Fecha o popup
    popup.style.display = "none";
}

// Adiciona um evento ao botão para abrir o popup
var btnAbrirPopup = document.getElementById("btnAbrirPopup");
btnAbrirPopup.addEventListener("click", exibirPopup);