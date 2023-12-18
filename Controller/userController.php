<?php
    include '../Model/user.php';
    include '../Model/user_sessionData.php';
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
            } catch(\PDOException $error){
                $_SESSION['errorSystem'] = ($error);
                return false;
            }

            // PUXAR OS DADOS DO ENV E USER SESSION DATA
            $env = new env();
            $net = new user_sessionData();

            // CRIAR TOKEN DA SESSAO
            $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $keyWord = "";
            for ($i=0; $i<16;$i++){
                $keyWord .= $caracteres[rand(0, strlen($caracteres) - 1)];
            }

            // CRIPTOGRAFAR TOKEN DA SESSAO
            $key = $env->getPasswordSecret();
            $payload = [
                'sub' => $keyWord,
            ];
            $net->setIdSession(JWT::encode($payload, $key ,'HS256'));

            // PEGAR IP E MAC ADDRESS
            $net->setIp($_SERVER['REMOTE_ADDR']);

            $ipAddress=$_SERVER['REMOTE_ADDR'];
            $macAddr=false;
            
            $arp=`arp -a $ipAddress`;
            $lines=explode("\n", $arp);
            
            foreach($lines as $line)
            {
                $cols=preg_split('/\s+/', trim($line));
                if ($cols[0]==$ipAddress)
                {
                    $macAddr=$cols[1];
                }
            }

            $net->setMacAddress($macAddr);

            // PEGAR DATA E HORA ATUAIS DA CRIACAO
            $date = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
            $net->setCreatedAt($date->format('Y-m-d H:i:s'));

            try {
                $sql2 = "INSERT INTO user_session_data (idSession, idUser, ip, macAddress, created_at) VALUES (?, ?, ?, ?, ?)";
                $tmp2 = conexao::getConexao()->prepare($sql2);
                $tmp2->bindValue(1, $net->getIdSession());
                $tmp2->bindValue(2, $user['id']);
                $tmp2->bindValue(3, $net->getIp());
                $tmp2->bindValue(4, $net->getMacAddress());
                $tmp2->bindValue(5, $net->getCreatedAt());
                $tmp2->execute();                
            } catch (\Throwable $error) {
                $_SESSION['errorSystem'] = ($error);
                return false;
            }

            header("Location: https://linktr.ee/unimedsjc");
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