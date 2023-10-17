<?php
    include '../Model/user.php';
    include '../Model/conexao.php';
    include '../Model/env.php';
    include '../Rules/cpf.php';
    include '../Rules/password.php';
    include '../Rules/phone.php';

    require '../vendor/autoload.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    session_start();

    class userController{
        

        public function login(){
            session_unset();
            $u = new user();

            $u->setEmail($_POST['email']);
            $u->setPassword($_POST['password']);

            $_SESSION['getEmail'] = $u->getEmail();

            try{
                $sql = "SELECT * FROM user WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getEmail());
                $tmp->execute();

                $user = $tmp->fetch(\PDO::FETCH_ASSOC);

                if(!isset($user['email'])){
                    $_SESSION['errorGeneral'] = "Usuário ou senha inválidos";
                    return false;
                }elseif(!(password_verify($u->getPassword(),$user['password']))){
                    $_SESSION['errorGeneral'] = "Usuário ou senha inválidos";
                    return false;
                }
                header("Location: https://linktr.ee/unimedsjc");
            } catch(\PDOException $error){
                $_SESSION['errorSystem'] = ($error);
                return false;
            }
        }

        public function register(){
            session_unset();
            $errorValidation=false;

            $u = new user();            

            $u->setName($_POST['name']);
            $u->setEmail($_POST['email']);
            $u->setCPF(str_replace(['.', '-'],'',$_POST['cpf']));
            $u->setPhone(str_replace([' ', '(', ')', '-'],'',$_POST['phone']));
            $u->setPassword($_POST['password']);

            $_SESSION['getName'] = $u->getName();
            $_SESSION['getEmail'] = $u->getEmail();
            $_SESSION['getCPF'] = $u->getCPF();
            $_SESSION['getPhone'] = $u->getPhone();

            // Valida se CPF e E-mail já existem
            $sql = "SELECT * FROM user WHERE email=? || cpf=?";
            $tmp = conexao::getConexao()->prepare($sql);
            $tmp->bindValue(1, $u->getEmail());
            $tmp->bindValue(2, $u->getCPF());
            $tmp->execute();
            
            $user = $tmp->fetch(\PDO::FETCH_ASSOC);

            if($user != false){
                if($user['email'] == $u->getEmail()){
                    $_SESSION['emailError'] = 'Esse E-mail já está em uso';
                    $errorValidation = true; 
                }
                
                if($user['cpf'] == $u->getCPF()){
                    $_SESSION['cpfError'] = 'Esse CPF já está em uso';
                    $errorValidation = true;  
                }
            }

            // Validação CPF
            if(!validaCPF($u->getCPF())){
                $_SESSION['cpfError'] = 'CPF inválido!';
                $errorValidation = true;
            }

            // Validação Telefone
            if(!validaPhone($u->getPhone())){
                $_SESSION['phoneError'] = 'Telefone inválido!';
                $errorValidation = true;
            }

            // Validação senha
            if(!validaSenha($u->getPassword())){
                $_SESSION['passError'] = 'Senha não atende os requisitos!';
                $errorValidation = true;
            }

            // Verifica se existe algum erro
            if($errorValidation == true){
                return ;
            }


            // Converte para hash
            $u->setPassword(PASSWORD_HASH($u->getPassword(), PASSWORD_BCRYPT));

            try{
                $sql = "INSERT INTO user (name, email, cpf, phone, password) VALUES (?,?,?,?,?)";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getName());
                $tmp->bindValue(2, $u->getEmail());
                $tmp->bindValue(3, $u->getCPF());
                $tmp->bindValue(4, $u->getPhone());
                $tmp->bindValue(5, $u->getPassword());
                $tmp->execute();

                $_SESSION['status'] = "Cadastro realizado com sucesso";
                header("Location: /CaptivePortal/Views/login.php");
            } catch(\PDOException $error){
                $_SESSION['errorSystem'] = $error;
                return false;
            }
        }

        public function resetPassword(){
            session_unset();
            $u = new user();
            $env = new env();

            // E-mail descriptografado
            try {
                $key = $env->getPasswordSecret();
                $decoded = JWT::decode($_GET['email'], new Key($key, 'HS256'));
                $decoded_array = (array) $decoded;
            } catch (\Throwable $th) {
                $_SESSION['errorGeneral'] = 'Link expirou';
                return header("Location: /CaptivePortal/Views/login.php");
            }

            $u->setEmail($decoded_array['sub']);
            $u->setPassword($_POST['password']);

            if(!validaSenha($u->getPassword())){
                $_SESSION['passError'] = 'Senha não atende aos requisitos!';
                return false;
            }

            // Converte para hash
            $u->setPassword(PASSWORD_HASH($u->getPassword(), PASSWORD_BCRYPT));

            try{
                $sql = "UPDATE user SET password=? WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getPassword());
                $tmp->bindValue(2, $u->getEmail());
                $tmp->execute();

                $_SESSION['status'] = "Senha redefinida com sucesso";
                return header("Location: /CaptivePortal/Views/login.php");
            } catch(\PDOException $error){
                $_SESSION['errorSystem'] = $error;
                return false;
            }
        }

        public function unsubscribeUser(){
            session_unset();
            $u = new user();

            $env = new env();

            // E-mail descriptografado
            try {
                $key = $env->getPasswordSecret();
                $decoded = JWT::decode($_GET['email'], new Key($key, 'HS256'));
                $decoded_array = (array) $decoded;
            } catch (\Throwable $th) {
                $_SESSION['errorGeneral'] = 'Link expirou';
                return header("Location: /CaptivePortal/Views/login.php");
            }
            

            $u->setEmail($decoded_array['sub']);
            
            try {
                $sql = "DELETE FROM user WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getEmail());
                $tmp->execute();

                return false;
            } catch(\PDOException $error){
                $_SESSION['errorSystem'] = $error;
                return false;
            }
            
        }
    }

?>