// FUNÇÃO PARA ATIVAR E DESATIVAR O MODAL "TERMO DE EXCLUSÃO DE DADOS" AO CLICAR NO "LINK"
function function_user_data() {
    var popupAgree = document.getElementById("popup_user_agreement");
    if(popupAgree.classList.contains('show')){
        popupAgree.classList.toggle('show');
    }
    document.getElementById("popup_user_data").classList.toggle("show");
}

// FUNÇÃO AUTO INVOCAVEL(IIFE) PARA FECHAR O MODAL "TERMO DE EXCLUSÃO DE DADOS" AO CLICAR EM QUALQUER LUGAR FORA DO FORMULARIO
(function (){
    document.addEventListener('click', (event) => {
        var popup = document.getElementById("popup_user_data");
        var form = document.getElementById("registerForm")

        if(!(form.contains(event.target))){
            if(popup.classList.contains('show')){
                popup.classList.toggle('show');
            }
        }
    });
})();