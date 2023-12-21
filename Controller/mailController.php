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
        // CONEXÃO COM O E-MAIL
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();

        // DADOS DA CONEXÃO
        $phpmailer->Host = 'mail.unimedsjc.com.br';
        $phpmailer->Port = 587;
        $phpmailer->SMTPAuth = false;

        // DEFINICAO DA CODIFICACAO DE CARACTERES
        $phpmailer->CharSet = "UTF-8";

        // CONEXÃO COM O BANCO
        $u = new user();
        $u->setEmail($_POST['email']);

        // PUXAR OS DADOS DO ENV
        $env = new env();

        // E-MAIL CRIPTOGRAFADO
        $key = $env->getPasswordSecret();
        $payload = [
            'sub' => $u->getEmail(),
            'exp' => $_SERVER['REQUEST_TIME']+600
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

        // PRÉ DEFINIÇÃO DO E-MAIL (ASSUNTO, CONTEUDO, REMETENTE E DESTINATARIO)
        $mail = new mail();
        $mail->setSender('ti.forgot-password@unimedsjc.coop.br');
        $mail->setReceiver($u->getEmail());
        $mail->setSubject('Pedido de redefinição da senha');
        $mail->setContent('<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Forgot Password</title><body style="margin:0;width:100vw;height:100vh;font:20px Calibri;">');
        $mail->setContent('<h2>Olá '.$user['name'].',</h2>');
        $mail->setContent('<p style="margin:0">Se você não solicitou a redefinição de senha, sinta-se à vontade para descartar este e-mail. Se solicitou, <a href="http://localhost/captiveportal/views/resetPassword.php?email='.$EncodeEmail.'">clique aqui.</a></p>');
        $mail->setContent('<br/><p>Estamos à disposição! 😊 <br/> <b>Unimed São José dos Campos - Cooperativa de Trabalho Médico</b></p>');
        $mail->setContent('</body></html>');


        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), "Don't reply");
        $phpmailer->AddAddress($mail->getReceiver(), $user['name']);
        $phpmailer->Subject = $mail->getSubject();
        $content = $mail->getContent($mail->getReceiver());


        // ENVIO
        $phpmailer->MsgHTML($content);
        if(!$phpmailer->Send()) {
            $_SESSION['errorSystem'] = $phpmailer->ErrorInfo;
            // $phpmailer->SMTPDebug;
            return false;
        } else {
            $_SESSION['status'] = "E-mail enviado com sucesso";
            header("Location: /CaptivePortal/Views/login.php");
            return true;
        }
    }

    /* FUNCAO COMENTADA, POIS NÃO SERÁ MAIS UTILIZADA. CONTUDO, MANTEREMOS COMENTADA PARA POSSIVEL UTILIZAÇÃO FUTURA E EVITAR RETRABALHO
    public function sendUnsubscribeInvitation(){
        session_unset();
        // CONEXAO EMAIL
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();

        // DADOS DA CONEXAO
        $phpmailer->Host = 'mail.unimedsjc.com.br';
        $phpmailer->Port = 587;
        $phpmailer->SMTPAuth = false;

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
            'exp' => $_SERVER['REQUEST_TIME']+600
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
        $mail->setSender('ti.unsubscribe@unimedsjc.coop.br');
        $mail->setReceiver($u->getEmail());
        $mail->setSubject('Pedido de exclusão dos dados');
        $mail->setContent('<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Forgot Password</title><body style="margin:0;width:100vw;height:100vh;font:20px Calibri;">');
        $mail->setContent('<h2>Olá '.$user['name'].',</h2>');
        $mail->setContent('<p style="margin:0">Se você não solicitou a exclusão do cadastro, pode ignorar este e-mail. Se solicitou, <a href="http://localhost/captiveportal/views/unsubscribeAccept.php?email='.$EncodeEmail.'">clique aqui</a>. </p>');
        $mail->setContent('<br/><p>Estamos à disposição! 😊 <br/> <b>Unimed São José dos Campos - Cooperativa de Trabalho Médico</b></p>');
        $mail->setContent('</body></html>');


        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), "Don't reply");
        $phpmailer->AddAddress($mail->getReceiver(), $user['name']);
        $phpmailer->Subject = $mail->getSubject();
        $content = $mail->getContent($mail->getReceiver());


        // ENVIO
        $phpmailer->MsgHTML($content);
        if(!$phpmailer->Send()) {
            $_SESSION['errorSystem'] = $phpmailer->ErrorInfo;
            return false;
        } else {
            $_SESSION['status'] = "E-mail enviado com sucesso";
            header("Location: /CaptivePortal/Views/login.php");
            return true;
        }
    }*/
}

?>