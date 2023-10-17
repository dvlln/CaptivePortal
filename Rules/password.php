<?php
function validaSenha($password){
    
    // Valida se há numero, letra minuscula, letra maiuscula e caracter
    // $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    // $specialChars = preg_match('@[^\w]@', $password);

    if(!$lowercase || !$number || strlen($password) < 6) {
        return false;
    }
    return true;
}
?>