<?php
	class User{
		protected $id;
		private $name;
		private $email;
		private $cpf;
		private $phone;
		private $password;

        public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}

        public function getName(){
			return $this->name;
		}
		public function setName($name){
			$this->name = $name;
		}

        public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}
		public function getCPF(){
			return $this->cpf;
		}
		public function setCPF($cpf){
			$this->cpf = $cpf;
		}
		public function getPhone(){
			return $this->phone;
		}
		public function setPhone($phone){
			$this->phone = $phone;
		}

        public function getPassword(){
			return $this->password;
		}
		public function setPassword($password){
			$this->password = $password;
		}
    }

?>