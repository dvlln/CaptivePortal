<?php

session_start();

include '../Model/mail.php';
include '../Model/user.php';
include '../Model/conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/PHPMailer-master/src/Exception.php';
require '../vendor/PHPMailer-master/src/PHPMailer.php';
require '../vendor/PHPMailer-master/src/SMTP.php';

class mailController{
    public function redefinirSenha(){
        // CONEXAO EMAIL
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '017b415f8e140d';
        $phpmailer->Password = '36dc0603908e82';
        $phpmailer->CharSet = "UTF-8";

        // CONEXAO BANCO
        $u = new user();
        $u->setEmail($_POST['email']);

        $sql = "SELECT * FROM user WHERE email=?";
        $tmp = conexao::getConexao()->prepare($sql);
        $tmp->bindValue(1, $u->getEmail());
        $tmp->execute();

        $user = $tmp->fetch(\PDO::FETCH_ASSOC);

        // PRESET
        $mail = new mail();
        $mail->setSender('ti.forgot-password@gmail.com');
        $mail->setReceiver($u->getEmail());
        $mail->setSubject('Pedido de redefinição de senha');
        $mail->setContent('<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Forgot Password</title><body style="margin:0;width:100vw;height:100vh;font:20px Calibri;">');
        $mail->setContent('<div style="width:100%;height:100%;display:flex;flex-direction:column;justify-content:space-between;"><div style="display:flex;flex-direction:column;margin:20px;">');
        $mail->setContent('<h2>Olá :]</h2>');
        $mail->setContent('<p>Ficamos sabendo que você esqueceu a senha.☹️<br/>Mas não se preocupe, daremos um jeitinho para você.</p>');
        $mail->setContent('<p style="margin-bottom: 40px; font-weight:bold; color:red;">Caso não tenho sido você que pediu a redefinição de senha, pode ignorar esse e-mail. Caso tenha sido, clique no link abaixo.😉</p>');
        $mail->setContent('<a href="http://localhost/captiveportal/views/resetPassword.php?email='.$u->getEmail().'" style="text-align:center;font-size:25px;text-decoration:none;background-color:rgb(67,119,67);color:white;padding:20px 26px;border:2px solid rgb(67,119,67);border-radius:40px;box-shadow:0 4px 4px rgba(0,0,0,.08),0 4px 8px rgba(0,0,0,.12),0 4px 16px rgba(0,0,0,.24);cursor:pointer;align-self:center;">Redefinir senha</a>');
        $mail->setContent('</div>');
        $mail->setContent('<div style="position:relative;bottom:10px;text-align:center;font-size:15px;">');
        $mail->setContent('<b style="font-size:20px;">Enviado por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023</b>');
        $mail->setContent('</div></div></div></body></html>');


        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), "DON'T REPLY");
        $phpmailer->AddAddress($mail->getReceiver(), $user['nome']);
        $phpmailer->Subject = $mail->getSubject();
        $content = $mail->getContent($mail->getReceiver());


        // ENVIO
        $phpmailer->MsgHTML($content);
        if(!$phpmailer->Send()) {
            $_SESSION['error'] = $phpmailer->ErrorInfo;
            return false;
        } else {
            session_destroy();
            return true;
        }
    }

    public function desinscrever(){
        // CONEXAO EMAIL
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'cbfd12c278dd0e';
        $phpmailer->Password = '354a5cee4d6bb8';
        $phpmailer->CharSet = "UTF-8";

        // CONEXAO BANCO
        $u = new user();
        $u->setEmail($_POST['email']);

        $sql = "SELECT * FROM user WHERE email=?";
        $tmp = conexao::getConexao()->prepare($sql);
        $tmp->bindValue(1, $u->getEmail());
        $tmp->execute();

        $user = $tmp->fetch(\PDO::FETCH_ASSOC);

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
        $mail->setContent('<a href="http://localhost/captiveportal/views/resetPassword.php?email='.$u->getEmail().'" style="text-align:center;font-size:25px;text-decoration:none;background-color:rgb(67,119,67);color:white;padding:20px 26px;border:2px solid rgb(67,119,67);border-radius:40px;box-shadow:0 4px 4px rgba(0,0,0,.08),0 4px 8px rgba(0,0,0,.12),0 4px 16px rgba(0,0,0,.24);cursor:pointer;align-self:center;">Redefinir senha</a>');
        $mail->setContent('</div>');
        $mail->setContent('<div style="position:relative;bottom:10px;text-align:center;font-size:15px;">');
        $mail->setContent('<b style="font-size:20px;">Enviado por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023</b>');
        $mail->setContent('</div></div></div></body></html>');


        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), "DON'T REPLY");
        $phpmailer->AddAddress($mail->getReceiver(), $user['nome']);
        $phpmailer->Subject = $mail->getSubject();
        $content = $mail->getContent($mail->getReceiver());


        // ENVIO
        $phpmailer->MsgHTML($content);
        if(!$phpmailer->Send()) {
            $_SESSION['error'] = $phpmailer->ErrorInfo;
            return false;
        } else {
            session_destroy();
            return true;
        }
    }
}

?>