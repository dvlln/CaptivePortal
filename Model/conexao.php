<?php
    class Conexao{
        private static $instance;
        public static function getConexao(){
            $env = new env();
            $user = $env->GetDbUser();
            $pass = $env->GetDbPassword();

            if(!isset(self::$instance)){
                self::$instance = new \PDO('mysql:host=localhost;dbname=hotspot;charset=utf8', $user, $pass);
            }
            return self::$instance;
        }
}
?>