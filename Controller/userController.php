<?php
    include '../Model/user.php';
    include '../Model/conexao.php';
    class userController{
        public function cadastrar(){
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['cpf']) && isset($_POST['telefone']) && isset($_POST['password']) ) {
                $u = new user();

                $u->setNome($_POST['name']);
                $u->setEmail($_POST['email']);
                $u->setCPF($_POST['cpf']);
                $u->setTelefone($_POST['telefone']);
                $u->setSenha($_POST['password']);

                try{
                    $sql = "INSERT INTO user (name, email, cpf, telefone, password) VALUES (?,?,?,?,?)";
                    $tmp = conexao::getConexao()->prepare($sql);
                    $tmp->bindValue(1, $u->getNome());
                    $tmp->bindValue(2, $u->getEmail());
                    $tmp->bindValue(3, $u->getCPF());
                    $tmp->bindValue(4, $u->getTelefone());
                    $tmp->bindValue(5, $u->getSenha());
                    $tmp->execute();
    
                    header("Location: /CaptivePortal/Views/login.php");
                } catch(\PDOException $error){
                    return $error;
                }
            }else{
                header("Location: /CaptivePortal/Views/register.php");
            }
        }
    }

?>