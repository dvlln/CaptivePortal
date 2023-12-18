<?php
function validaSenha($password){

    if(strlen($password) < 6) {
        return false;
    }
    return true;
}
?>