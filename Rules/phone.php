<?php
function validaTelefone($phone){
    
    // Valida se há numero, letra minuscula, letra maiuscula e caracter
    $number = is_numeric($phone);

    if($number && strlen($phone) == 11) {
        return true;
    }
    return false;
}
?>

