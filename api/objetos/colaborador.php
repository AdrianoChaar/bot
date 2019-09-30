<?php
	class Colaborador{
		private $conn; private $table_name="tbl_colaborador"; public $id; public $nome; public $login; public $senha; 
		
		public function __construct($db){$this->conn=$db;}
		
		function create(){
			$query="INSERT INTO ".$this->table_name." SET nome=:nome, login=:login, senha=:senha";  $stmt=$this->conn->prepare($query);	
			$this->nome=htmlspecialchars(strip_tags($this->nome)); $this->login=htmlspecialchars(strip_tags($this->login)); $this->senha=htmlspecialchars(strip_tags($this->senha)); 
			$stmt->bindParam(":nome", $this->nome); $stmt->bindParam(":login", $this->login); $stmt->bindParam(":senha", $this->senha);
			if($stmt->execute()){return true;} return false;}		

		function read(){$query="SELECT * FROM ".$this->table_name; $stmt=$this->conn->prepare($query); $stmt->execute(); return $stmt;}
		
		function readOne(){
			$query="SELECT * FROM ".$this->table_name." WHERE id=? LIMIT 0,1"; $stmt=$this->conn->prepare($query); 
			$stmt->bindParam(1, $this->id); $stmt->execute(); $row=$stmt->fetch(PDO::FETCH_ASSOC);
			$this->nome=$row['nome']; $this->login=$row['login']; $this->senha=$row['senha'];}			
			
		function search($keywords){
			$query="SELECT * FROM ".$this->table_name." WHERE nome LIKE ? OR login LIKE ? ORDER BY nome ASC"; $stmt=$this->conn->prepare($query);
			$keywords=htmlspecialchars(strip_tags($keywords)); $keywords="%{$keywords}%"; $stmt->bindParam(1, $keywords); $stmt->bindParam(2, $keywords); 
			$stmt->execute(); return $stmt;}	
		
		function update(){
			$query="UPDATE ".$this->table_name." SET nome=:nome, login=:login, senha=:senha WHERE id=:id"; $stmt=$this->conn->prepare($query);
			$this->nome=htmlspecialchars(strip_tags($this->nome)); $this->login=htmlspecialchars(strip_tags($this->login)); $this->senha=htmlspecialchars(strip_tags($this->senha)); 
			$stmt->bindParam(':id', $this->id);	$stmt->bindParam(':nome', $this->nome); $stmt->bindParam(':login', $this->login); $stmt->bindParam(':senha', $this->senha);
			if($stmt->execute()){return true;} return false;}

		function delete(){
			$query="DELETE FROM ".$this->table_name." WHERE id=?"; $stmt=$this->conn->prepare($query); 
			$this->id=htmlspecialchars(strip_tags($this->id)); $stmt->bindParam(1, $this->id);
			if($stmt->execute()){return true;} return false;}		
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */	
	
		function login($keywords){
			//$Partes=explode("|", $keywords); $query="SELECT * FROM ".$this->table_name." WHERE login='".$Partes[0]."' AND senha='".$Partes[1]."'"; 
			$Partes=explode("|", $keywords); $query="SELECT * FROM ".$this->table_name." WHERE login=? AND senha=? LIMIT 0,1"; 
			$stmt=$this->conn->prepare($query); $keywords=htmlspecialchars(strip_tags($keywords));  
			$stmt->bindParam(1, $Partes[0]); $stmt->bindParam(2, $Partes[1]); 
			$stmt->execute(); return $stmt;}	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */