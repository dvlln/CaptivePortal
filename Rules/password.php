<?php
function validaSenha($password){

    // VALIDA A QUANTIDADE DE CARACTERES
    if(strlen($password) < 6) {
        return false;
    }
    return true;
}
?>