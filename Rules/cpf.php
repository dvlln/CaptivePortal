<?php
function validaCPF($cpf) {
 
    // EXTRAI SOMENTE OS NÚMEROS
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // VERIFICA SE FOI INFORMADO TODOS OS DIGITOS CORRETAMENTE
    if (strlen($cpf) != 11) {
        return false;
    }

    // VERIICA SE FOI INFORMADA UMA SEQUÊNCIA DE DIGITOS REPETIDOS. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // FAZ O CALCULO PARA VALIDAR O CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}