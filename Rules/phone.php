<?php
function validaPhone($phone){
    if(strlen($phone) != 11){
        return false;
    }
    return true;
}

?>