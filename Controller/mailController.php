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
        // CONECTION
        $phpmailer->Host = 'mail.unimedsjc.com.br';
        $phpmailer->Port = 25;
        $phpmailer->SMTPAuth = false;
        $phpmailer->SMTPAutoTLS = false;

        // PLUS
        $phpmailer->CharSet = "UTF-8";

        // CONEXAO BANCO
        $u = new user();
        $u->setEmail($_POST['email']);

        // PUXAR OS DADOS DO ENV
        $env = new env();

        // E-mail criptografado
        $key = $env->getPasswordSecret();
        $payload = [
            'sub' => $u->getEmail(),
            'exp' => '60',
        ];
        $EncodeEmail = JWT::encode($payload, $key ,'HS256');

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
        $mail->setContent('<h2>Olá '.$user['name'].'</h2>');
        $mail->setContent('<p style="margin-bottom: 40px; font-weight:bold; color:red;">Caso não tenho sido você quem pediu a redefinição de senha, pode ignorar esse e-mail.</p>');
        $mail->setContent('Caso tenha sido, <a href="http://localhost/captiveportal/views/resetPassword.php?email='.$EncodeEmail.'">clique aqui.</a>');
        $mail->setContent('<br/><br/><b>Desenvolvido por <a href="https://www.unimedsjc.com.br/">www.unimedsjc.com.br</a> © 2023 - todos os direitos reservados</b>');
        $mail->setContent('</body></html>');


        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), "Don't reply");
        $phpmailer->AddAddress($mail->getReceiver(), $user['name']);
        $phpmailer->Subject = $mail->getSubject();
        $content = $mail->getContent($mail->getReceiver());


        // ENVIO
        $phpmailer->MsgHTML($content);
        if(!$phpmailer->Send()) {
            $_SESSION['error'] = $phpmailer->ErrorInfo;
            // $phpmailer->SMTPDebug;
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
        $payload = [
            'sub' => $u->getEmail(),
            'exp' => '60',
        ];
        $EncodeEmail = JWT::encode($payload, $key ,'HS256');

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
        $mail->setContent('<h2>Olá '.$user['name'].'</h2>');
        $mail->setContent('<p>Ficamos sabendo que você quer se descadastrar :(</p>');
        $mail->setContent('<p style="margin-bottom: 40px; font-weight:bold; color:red;">Caso não tenho sido você a pedir a redefinição de senha, pode ignorar esse e-mail. </p>');
        $mail->setContent('Caso tenha sido, <a href="http://localhost/captiveportal/views/unsubscribeAccept.php?email='.$EncodeEmail.'">clique aqui</a>');
        $mail->setContent('<div style="position:relative;bottom:10px;text-align:center;font-size:15px;">');
        $mail->setContent('<br/><br/><b>Desenvolvido por <a href="https://www.unimedsjc.com.br/">www.unimedsjc.com.br</a> © 2023 - todos os direitos reservados</b>');
        $mail->setContent('</body></html>');


        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), "Don't reply");
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