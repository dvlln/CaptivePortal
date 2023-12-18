<?php
	class user_sessionData{
		private $idSession;
		private $idUser;
		private $ip;
		private $macAddress;
		private $created_at;
		private $updated_at;

        public function getIdSession(){
			return $this->idSession;
		}
		public function setIdSession($idSession){
			$this->idSession = $idSession;
		}

		public function getIdUser(){
			return $this->idUser;
		}
		public function setIdUser($idUser){
			$this->idUser = $idUser;
		}

		public function getIp(){
			return $this->ip;
		}
		public function setIp($ip){
			$this->ip = $ip;
		}

		public function getMacAddress(){
			return $this->macAddress;
		}
		public function setMacAddress($macAddress){
			$this->macAddress = $macAddress;
		}

		public function getCreatedAt(){
			return $this->created_at;
		}
		public function setCreatedAt($created_at){
			$this->created_at = $created_at;
		}
    }

?>