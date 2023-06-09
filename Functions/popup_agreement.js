// FUNÇÃO PARA ATIVAR E DESATIVAR O MODAL "TERMO DE USO E CONSENTIMENTO" AO CLICAR NO "LINK"
function function_user_agreement() {
    var popupData = document.getElementById("popup_user_data");
    if(popupData.classList.contains('show')){
        popupData.classList.toggle('show');
    }
    document.getElementById("popup_user_agreement").classList.toggle("show");
}

// FUNÇÃO AUTO INVOCAVEL(IIFE) PARA FECHAR O MODAL "TERMO DE USO E CONSENTIMENTO" AO CLICAR EM QUALQUER LUGAR FORA DO FORMULARIO
(function (){
    document.addEventListener('click', (event) => {
        var popup = document.getElementById("popup_user_agreement");
        var form = document.getElementById("registerForm")

        if(!(form.contains(event.target))){
            if(popup.classList.contains('show')){
                popup.classList.toggle('show');
            }
        }
    });
})();