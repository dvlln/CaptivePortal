<?php

namespace SRC\Model;
class Conexao{

    private static $instance;

    public static function getConexao(){
        if(!isset(self::$instance)){
            self::$instance = new \PDO('mysql:host=localhost;dbname=hotspot;charset=utf8', 'root', '');
        }
        return self::$instance;
        
    }
}
?>