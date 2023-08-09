<?php

session_start();

include '../Model/mail.php';
include '../Model/user.php';
include '../Model/conexao.php';
include '../Model/env.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
use Firebase\JWT\JWT;

class mailController{
    public function sendPasswordResetInvitation(){
        session_unset();
        // CONEXAO EMAIL
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'mail.unimedsjc.com.br';
        $phpmailer->Port = 25;
        $phpmailer->SMTPAuth = false;
        $phpmailer->SMTPAutoTLS = false;
        $phpmailer->CharSet = "UTF-8";

        // CONEXAO BANCO
        $u = new user();
        $u->setEmail($_POST['email']);

        // PUXAR OS DADOS DO ENV
        $env = new env();

        // E-mail criptografado
        $key = $env->getPasswordSecret();
        $payload = [$u->getEmail()];
        $EncodeEmail = JWT::encode($payload, $key ,'HS256');

        // $_SESSION['getEmail'] = $u->getEmail(); PRA QUE ALLAN????

        $sql = "SELECT * FROM user WHERE email=?";
        $tmp = conexao::getConexao()->prepare($sql);
        $tmp->bindValue(1, $u->getEmail());
        $tmp->execute();

        $user = $tmp->fetch(\PDO::FETCH_ASSOC);

        if(!isset($user['email'])){
            $_SESSION['errorEmail'] = "E-mail inexistente";
            return false;
        }

        // PRESET
        $mail = new mail();
        $mail->setSender('ti.forgot-password@unimedsjc.coop.br');
        $mail->setReceiver($u->getEmail());
        $mail->setSubject('Pedido de redefinição de senha');
        $mail->setContent('<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Forgot Password</title><body style="margin:0;width:100vw;height:100vh;font:20px Calibri;">');
        $mail->setContent('<div style="width:100%;height:100%;display:flex;flex-direction:column;justify-content:space-between;"><div style="display:flex;flex-direction:column;margin:20px;">');
        $mail->setContent('<h2>Olá :]</h2>');
        $mail->setContent('<p>Ficamos sabendo que você esqueceu a senha.☹️<br/>Mas não se preocupe, daremos um jeitinho para você.</p>');
        $mail->setContent('<p style="margin-bottom: 40px; font-weight:bold; color:red;">Caso não tenho sido você que pediu a redefinição de senha, pode ignorar esse e-mail. Caso tenha sido, clique no link abaixo.😉</p>');
        $mail->setContent('<a href="http://localhost/captiveportal/views/resetPassword.php?email='.$EncodeEmail.'"><button>Redefinir senha</button></a>');
        $mail->setContent('</div>');
        $mail->setContent('<div style="position:relative;bottom:10px;text-align:center;font-size:15px;">');
        $mail->setContent('<b style="font-size:20px;">Enviado por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023</b>');
        $mail->setContent('</div></div></div></body></html>');


        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), "DON'T REPLY");
        $phpmailer->AddAddress($mail->getReceiver(), $user['name']);
        $phpmailer->Subject = $mail->getSubject();
        $content = $mail->getContent($mail->getReceiver());


        // ENVIO
        $phpmailer->MsgHTML($content);
        if(!$phpmailer->Send()) {
            $_SESSION['error'] = $phpmailer->ErrorInfo;
            return false;
        } else {
            $_SESSION['status'] = "E-mail enviado com sucesso";
            header("Location: /CaptivePortal/Views/login.php");
            return true;
        }
    }

    public function sendUnsubscribeInvitation(){
        session_unset();
        // CONEXAO EMAIL
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'mail.unimedsjc.com.br';
        $phpmailer->Port = 25;
        $phpmailer->SMTPAuth = false;
        $phpmailer->SMTPAutoTLS = false;
        $phpmailer->CharSet = "UTF-8";

        // CONEXAO BANCO
        $u = new user();
        $u->setEmail($_POST['email']);

        // PUXAR OS DADOS DO ENV
        $env = new env();

        // E-mail criptografado
        $key = $env->getPasswordSecret();
        $payload = [$u->getEmail()];
        $EncodeEmail = JWT::encode($payload, $key ,'HS256');

        // $_SESSION['getEmail'] = $u->getEmail(); PRA QUE ALLAN????

        $sql = "SELECT * FROM user WHERE email=?";
        $tmp = conexao::getConexao()->prepare($sql);
        $tmp->bindValue(1, $u->getEmail());
        $tmp->execute();

        $user = $tmp->fetch(\PDO::FETCH_ASSOC);

        if(!isset($user['email'])){
            $_SESSION['errorEmail'] = "E-mail inexistente";
            return false;
        }

        // PRESET
        $mail = new mail();
        $mail->setSender('ti.unsubscribe@gmail.com');
        $mail->setReceiver($u->getEmail());
        $mail->setSubject('Pedido para descadastrar do site');
        $mail->setContent('<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Forgot Password</title><body style="margin:0;width:100vw;height:100vh;font:20px Calibri;">');
        $mail->setContent('<div style="width:100%;height:100%;display:flex;flex-direction:column;justify-content:space-between;"><div style="display:flex;flex-direction:column;margin:20px;">');
        $mail->setContent('<h2>Olá :]</h2>');
        $mail->setContent('<p>Ficamos sabendo que você quer se descadastrar☹️</p>');
        $mail->setContent('<p style="margin-bottom: 40px; font-weight:bold; color:red;">Caso não tenho sido você a pedir a redefinição de senha, pode ignorar esse e-mail. Caso tenha sido, clique no link abaixo.😉</p>');
        $mail->setContent('<a href="http://localhost/captiveportal/views/unsubscribeAccept.php?email='.$EncodeEmail.'"><button>Descadastrar</button></a>');
        $mail->setContent('</div>');
        $mail->setContent('<div style="position:relative;bottom:10px;text-align:center;font-size:15px;">');
        $mail->setContent('<b style="font-size:20px;">Enviado por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023</b>');
        $mail->setContent('</div></div></div></body></html>');


        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), "DON'T REPLY");
        $phpmailer->AddAddress($mail->getReceiver(), $user['name']);
        $phpmailer->Subject = $mail->getSubject();
        $content = $mail->getContent($mail->getReceiver());


        // ENVIO
        $phpmailer->MsgHTML($content);
        if(!$phpmailer->Send()) {
            $_SESSION['error'] = $phpmailer->ErrorInfo;
            return false;
        } else {
            $_SESSION['status'] = "E-mail enviado com sucesso";
            header("Location: /CaptivePortal/Views/login.php");
            return true;
        }
    }
}

?>