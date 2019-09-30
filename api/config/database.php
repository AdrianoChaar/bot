<?php
	//class Database{
	//	private $host="br12.hostgator.com.br"; private $db_name="adria873_bot_db"; private $username="adria873_servico"; private $password="!Rhysjordan4173!";	
	//	public $conn;
	//	public function getConnection(){$this->conn=null;
	//		try{
	//			$this->conn=new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password); 
	//			$this->conn->exec("set names utf8");
	//		}
	//		catch(PDOException $exception){echo "Erro de conexão: ".$exception->getMessage();}
	//		return $this->conn;
	//	}
	//}

	class Database{
		private $host="localhost"; private $db_name="bot"; private $username="root"; private $password="";	
		public $conn;
		public function getConnection(){$this->conn=null;
			try{
				$this->conn=new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password); 
				$this->conn->exec("set names utf8");
			}
			catch(PDOException $exception){echo "Erro de conexão: ".$exception->getMessage();}
			return $this->conn;
		}
	}	