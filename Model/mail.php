<?php

class mail{
		private $sender = 'ti@gmail.com';
		private $receiver;
		private $subject = 'Assunto de teste';
		private $content;


        public function getSender(){
			return $this->sender;
		}
        public function getReceiver(){
			return $this->receiver;
		}
		public function setReceiver($receiver){
			$this->receiver = $receiver;
		}
        public function getSubject(){
			return $this->subject;
		}
        public function getContent($email){
			$this->content = '<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Forgot Password</title></head><body style="margin:0;width:100vw;height:100vh;font:20px Calibri;>';
			$this->content .= '<div style="width:100%;height:100%;display:flex;flex-direction:column;justify-content:space-between;"><div style="display:flex;flex-direction:column;margin:20px;">';
			$this->content .= '<h2>Olá :]</h2>';
			$this->content .= '<p>Ficamos sabendo que você esqueceu a senha<br/>Mas não se preocupe, daremos um jeitinho para você</p>';
			$this->content .= '<p style="margin-bottom: 40px;">Basta clicar no link abaixo</p>';
			$this->content .= '<a href="http://localhost/captiveportal/views/teste.php?email='.$email.'" style="text-align:center;font-size:25px;text-decoration:none;background-color:rgb(67,119,67);color:white;padding:20px 26px;border:2px solid rgb(67,119,67);border-radius:40px;box-shadow:0 4px 4px rgba(0,0,0,.08),0 4px 8px rgba(0,0,0,.12),0 4px 16px rgba(0,0,0,.24);cursor:pointer;align-self:center;">Redefinir senha</a>';
			$this->content .= '</div>';
			$this->content .= '<div style="position:relative;bottom:10px;text-align:center;font-size:15px;">';
			$this->content .= '<b style="font-size:20px;">Enviado por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023</b>';
			$this->content .= '</div></div></div></body></html>';
			
			return $this->content;
		}
    }
?>