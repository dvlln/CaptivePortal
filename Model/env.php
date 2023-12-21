<?php

class env{
		private $dbUser = 'root';
		private $dbPassword;
		private $passwordSecret = '';


        public function getDbUser(){
			return $this->dbUser;
		}

        public function getDbPassword(){
			return $this->dbPassword;
		}

        public function getPasswordSecret(){
			return $this->passwordSecret;
		}
    }
?>