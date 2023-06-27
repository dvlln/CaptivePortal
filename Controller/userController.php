<?php
    include '../Model/user.php';
    include '../Model/conexao.php';
    include '../Rules/cpf.php';
    include '../Rules/password.php';
    session_start();

    class userController{
        public function login(){
            session_unset();
            $u = new user();

            $u->setEmail($_POST['email']);
            $u->setPassword($_POST['password']);

            try{
                $sql = "SELECT * FROM user WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getEmail());
                $tmp->execute();

                $user = $tmp->fetch(\PDO::FETCH_ASSOC);

                if(isset($user['email'])){
                    if(($user['email'] == $u->getEmail()) && ($user['password'] == $u->getPassword())){
                        header("Location: /CaptivePortal/Views/teste.php");
                    }else{
                        $_SESSION['error'] = "Usuário ou senha inválidos";
                        return false;
                    }
                }else{
                    $_SESSION['error'] = "Usuário inexistente";
                    return false;
                }
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

                if(!validaCPF($u->getCPF())){
                    if(!validaSenha($u->getPassword())){
                        $_SESSION['passError'] = 'Senha invalida!';
                        $_SESSION['cpfError'] = 'CPF inválido!';
                        return false;
                    }else{
                        $_SESSION['cpfError'] = 'CPF inválido!';
                        return false;
                    }
                }else{
                    if(!validaSenha($u->getPassword())){
                        $_SESSION['passError'] = 'Senha invlida!';
                        return false;
                    }
                }

                try{
                    $sql = "INSERT INTO user (name, email, cpf, phone, password) VALUES (?,?,?,?,?)";
                    $tmp = conexao::getConexao()->prepare($sql);
                    $tmp->bindValue(1, $u->getName());
                    $tmp->bindValue(2, $u->getEmail());
                    $tmp->bindValue(3, $u->getCPF());
                    $tmp->bindValue(4, $u->getPhone());
                    $tmp->bindValue(5, $u->getPassword());
                    $tmp->execute();
    
                    $_SESSION['status'] = "Cadastro realizado";
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

            try{
                $sql = "UPDATE user SET password=? WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getPassword());
                $tmp->bindValue(2, $u->getEmail());
                $tmp->execute();

                $_SESSION['status'] = "Senha redefinida";
                return header("Location: /CaptivePortal/Views/login.php");
            } catch(\PDOException $error){
                $_SESSION['error'] = ($error);
                return false;
            }
        }

        public function unsubscribeUser(){
            session_unset();
            $u = new user();

            $u->setEmail($_GET['email']);
            
            $sql = "DELETE FROM user WHERE email=?";
            $tmp = conexao::getConexao()->prepare($sql);
            $tmp->bindValue(1, $u->getEmail());
            $tmp->execute();
        }
    }

?>