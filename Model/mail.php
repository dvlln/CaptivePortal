<?php

class mail{
		private $sender;
		private $receiver;
		private $subject;
		private $content;


        public function getSender(){
			return $this->sender;
		}

		public function setSender($sender){
			$this->sender = $sender;
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

		public function setSubject($subject){
			$this->subject = $subject;
		}

        public function getContent($email){			
			return $this->content;
		}

		public function setContent($content){
			$this->content .= $content;
		}
    }
?>