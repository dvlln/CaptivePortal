<?php

namespace SRC\Controller;
require_once "../vendor/autoload.php";

    class userController{
        public function cadastrar(){
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['cpf']) && isset($_POST['telefone']) && isset($_POST['password']) ) {
                $u = new \SRC\Model\Usuario();

                $u->setNome($_POST['nome']);
                $u->setEmail($_POST['email']);
                $u->setCPF($_POST['CPF']);
                $u->setTelefone($_POST['telefone']);
                $u->setSenha($_POST['senha']);

                // try{
                    $sql = "INSERT INTO usuario (nome, email, cpf, telefone, senha) VALUES (?,?,?,?,?)";
                    $tmp = \SRC\Model\Conexao::getConexao()->prepare($sql);
                    $tmp->bindValue(1, $u->getNome());
                    $tmp->bindValue(2, $u->getEmail());
                    $tmp->bindValue(3, $u->getCPF());
                    $tmp->bindValue(4, $u->getTelefone());
                    $tmp->bindValue(5, $u->getSenha());
                    // $tmp->bindValue(5, hash('sha256', ($u->getSenha(). $u->getSalt())));
                    $tmp->execute();
    
                    header("Location: /CaptivePortal-Unimed/Views/login");
                // } catch(\PDOException $error){
                //     // $_SESSION['message'] = "Erro no cadastro!!!";
                //     return false;
                // }
            }else{
                header("Location: /CaptivePortal-Unimed/Views/unsubscribe");
            }
        }
    }

?>