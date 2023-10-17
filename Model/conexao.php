<?php
    class Conexao{
        private static $instance;
        public static function getConexao(){
            $env = new env();
            $user = $env->getDbUser();
            $pass = $env->getDbPassword();

            if(!isset(self::$instance)){
                self::$instance = new \PDO('mysql:host=localhost;dbname=hotspot;charset=utf8', $user, $pass);
            }
            return self::$instance;
        }
}
?>