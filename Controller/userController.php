<?php
    include '../Model/user.php';
    include '../Model/conexao.php';
    session_start();

    class userController{
        public function login(){
            session_unset();

            $u = new user();

            $u->setEmail($_POST['email']);
            $u->setSenha($_POST['password']);

            try{
                $sql = "SELECT * FROM user WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getEmail());
                $tmp->execute();

                $user = $tmp->fetch(\PDO::FETCH_ASSOC);

                if(isset($user['email'])){
                    if(($user['email'] == $u->getEmail()) && ($user['senha'] == $u->getSenha())){
                        header("Location: /CaptivePortal/Views/teste.php");
                    }else{
                        $_SESSION['error'] = "Usuário ou senha invalidos";
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

        public function cadastrar(){
                session_unset();
                $u = new user();

                $u->setNome($_POST['name']);
                $u->setEmail($_POST['email']);
                $u->setCPF($_POST['cpf']);
                $u->setTelefone($_POST['telefone']);
                $u->setSenha($_POST['password']);

                try{
                    $sql = "INSERT INTO user (nome, email, cpf, telefone, senha) VALUES (?,?,?,?,?)";
                    $tmp = conexao::getConexao()->prepare($sql);
                    $tmp->bindValue(1, $u->getNome());
                    $tmp->bindValue(2, $u->getEmail());
                    $tmp->bindValue(3, $u->getCPF());
                    $tmp->bindValue(4, $u->getTelefone());
                    $tmp->bindValue(5, $u->getSenha());
                    $tmp->execute();
    
                    $_SESSION['status'] = "Cadastro realizado";
                    header("Location: /CaptivePortal/Views/login.php");
                } catch(\PDOException $error){
                    $_SESSION['error'] = ($error);
                    return false;
                }
        }

        public function redefinirSenha(){
            session_unset();
            $u = new user();

            $u->setEmail($_GET['email']);
            $u->setSenha($_POST['password']);

            try{
                $sql = "UPDATE user SET senha=? WHERE email=?";
                $tmp = conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getSenha());
                $tmp->bindValue(2, $u->getEmail());
                $tmp->execute();

                $_SESSION['status'] = "Senha redefinida";
                return header("Location: /CaptivePortal/Views/login.php");
            } catch(\PDOException $error){
                $_SESSION['error'] = ($error);
                return false;
            }
        }

        public function descadastrar(){
            session_unset();
            $u = new user();

            $u->setEmail($_GET['email']);
            $u->setSenha($_POST['password']);
        }
    }

?>