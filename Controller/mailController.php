<?php

session_start();

include '../Model/mail.php';
include '../Model/user.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/PHPMailer-master/src/Exception.php';
require '../vendor/PHPMailer-master/src/PHPMailer.php';
require '../vendor/PHPMailer-master/src/SMTP.php';

class mailController{
    public function mailing(){
        // CONEXAO
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'cbfd12c278dd0e';
        $phpmailer->Password = '354a5cee4d6bb8';
        $phpmailer->CharSet = "UTF-8"; 

        // PRESET
        $mail = new mail();
        $mail->setReceiver($_POST['email']);
        // $_SESSION['email'] = ''.$mail->getReceiver();
        // $mail->setContent(file_get_contents('http://localhost/captiveportal/views/forgotpasswordlayout.php'));

        $phpmailer->IsHTML(true);
        $phpmailer->SetFrom($mail->getSender(), 'TESTE');
        $phpmailer->AddAddress($mail->getReceiver(), 'FULANO');
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