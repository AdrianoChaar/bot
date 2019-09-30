<?php
	class Acesso{
		private $conn; private $table_name="tbl_acesso"; public $id; public $user_id; public $entrada; public $dt_entrada; public $hr_entrada; 
		
		public function __construct($db){$this->conn=$db;}
		
		function read(){$query="SELECT * FROM ".$this->table_name; $stmt=$this->conn->prepare($query); $stmt->execute(); return $stmt;}

		function create(){
			$query="INSERT INTO ".$this->table_name." SET user_id=:user_id, entrada=:entrada, dt_entrada=:dt_entrada, hr_entrada=:hr_entrada"; $stmt=$this->conn->prepare($query);	
			$this->user_id=htmlspecialchars(strip_tags($this->user_id)); $this->entrada=htmlspecialchars(strip_tags($this->entrada)); 
			$this->dt_entrada=htmlspecialchars(strip_tags($this->dt_entrada)); $this->hr_entrada=htmlspecialchars(strip_tags($this->hr_entrada)); 
			$stmt->bindParam(":user_id", $this->user_id); $stmt->bindParam(":entrada", $this->entrada);
			$stmt->bindParam(":dt_entrada", $this->dt_entrada); $stmt->bindParam(":hr_entrada", $this->hr_entrada);
			if($stmt->execute()){return true;} return false;}	

		function marcacao($keywords){
			$query="SELECT * FROM ".$this->table_name."	WHERE user_id=? ORDER BY dt_entrada, entrada ASC "; 	
 			$stmt=$this->conn->prepare($query); $keywords=htmlspecialchars(strip_tags($keywords)); $keywords="$keywords"; 
			$stmt->bindParam(1, $keywords); $stmt->execute(); return $stmt;}	




/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */	
}