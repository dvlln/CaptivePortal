<?php

namespace SRC\Model;

	class Usuario{
		protected $id;
		private $nome;
		private $email;
		private $cpf;
		private $telefone;
		private $senha;
		private $salt= "UKDH9H2965pYRlU";

        public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}

		public function getSalt(){
			return $this->salt;
		}

        public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome = $nome;
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
		public function getTelefone(){
			return $this->telefone;
		}
		public function setTelefone($telefone){
			$this->telefone = $telefone;
		}

        public function getSenha(){
			return $this->senha;
		}
		public function setSenha($senha){
			$this->senha = $senha;
		}
    }

?>