<?php
    include '../Model/user.php';
    include '../Model/conexao.php';
    include '../Rules/cpf.php';
    include '../Rules/password.php';
    session_start();

    class userController{
        private $error;

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
                    $_SESSION['errorLogin'] = "Usuário ou senha inválidos";
                    return false;
                }elseif(!(password_verify($u->getPassword(),$user['password']))){
                    $_SESSION['errorLogin'] = "Usuário ou senha inválidos";
                    return false;
                }
                header("Location: /CaptivePortal/Views/teste.php");
            } catch(\PDOException $error){
                $_SESSION['error'] = ($error);
                return false;
            }
        }

        public function register(){
                session_unset();
                $u = new user();

                $u->setName($_POST['name']);
                $u->setEmail($_POST['email']);
                $u->setCPF($_POST['cpf']);
                $u->setPhone($_POST['phone']);
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

                if(isset($user['cpf'])){
                    $_SESSION['cpfError'] = 'Esse CPF já está em uso';
                    $error = true;  
                }

                if(isset($user['email'])){
                    $_SESSION['emailError'] = 'Esse E-mail já está em uso';
                    $error = true; 
                }

                // Validação senha
                if(!validaSenha($u->getPassword())){
                    $_SESSION['passError'] = 'Senha inválida!';
                    $error = true;
                }

                // Verifica se existe algum erro
                if($error){
                    return ;
                }
                if(!validaCPF($u->getCPF())){
                    $_SESSION['cpfError'] = 'CPF inválido!';
                    $error = true;
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
                    $_SESSION['error'] = $error;
                    return false;
                }
        }

        public function resetPassword(){
            session_unset();
            $u = new user();

            $u->setEmail($_GET['email']);
            $u->setPassword($_POST['password']);

            if(!validaSenha($u->getPassword())){
                $_SESSION['passError'] = 'Senha inválida!';
                return false;
            }

            try{
                $sql = "UPDATE user SET password=? WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getPassword());
                $tmp->bindValue(2, $u->getEmail());
                $tmp->execute();

                $_SESSION['status'] = "Senha redefinida com sucesso";
                return header("Location: /CaptivePortal/Views/login.php");
            } catch(\PDOException $error){
                $_SESSION['error'] = $error;
                return false;
            }
        }

        public function unsubscribeUser(){
            session_unset();
            $u = new user();

            $u->setEmail($_GET['email']);
            
            try {
                $sql = "DELETE FROM user WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getEmail());
                $tmp->execute();

                return false;
            } catch(\PDOException $error){
                $_SESSION['error'] = $error;
                return false;
            }
            
        }
    }

?>