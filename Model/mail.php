<?php


class mail{
		private $sender = 'ti@gmail.com';
		private $receiver;
		private $subject = 'Assunto de teste';
		private $content = 'TESTE TESTE TESTE';

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
        public function getContent(){
			return $this->content;
		}
    }
?>