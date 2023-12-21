<?php
function validaPhone($phone){
    // VAlIDA A QUANTIDADE DE CARACTERES
    if(strlen($phone) != 11){
        return false;
    }
    return true;
}

?>