<?php
	$_POST['ordem']=(isset($_POST['ordem'])) ? $_POST['ordem']:1; $_POST['campo']=(isset($_POST['campo'])) ? $_POST['campo']:'id';
	$SortCmp=$_POST["campo"]; $SortOrder=$_POST["ordem"]; 
	
	header("Access-Control-Allow-Origin: *"); header("Content-Type: application/json; charset=UTF-8");
	include_once '../config/database.php'; include_once '../objetos/acesso.php';
 	
	$database=new Database(); $db=$database->getConnection();
	$acesso=new Acesso($db); $stmt=$acesso->read(); $num=$stmt->rowCount();
	
	if($num>0){
		$acesso_arr=array(); $acesso_arr["registros"]=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row); 
			$acesso_item=array("id"=>$id, "user_id"=>$user_id, "entrada"=>$entrada, "dt_entrada"=>$dt_entrada, "hr_entrada"=>$hr_entrada);
		array_push($acesso_arr["registros"], $acesso_item);}
		$SortArr=array_column($acesso_arr["registros"], $SortCmp); 
		
		if($SortOrder==1){array_multisort($SortArr, SORT_ASC, $acesso_arr["registros"]);}
		else if($SortOrder==0){array_multisort($SortArr, SORT_DESC, $acesso_arr["registros"]);}
		else{array_multisort($SortArr, SORT_ASC, $acesso_arr["registros"]);}
		
		http_response_code(200); echo json_encode($acesso_arr);
	}else{http_response_code(404); echo json_encode(array("message" => "Nenhum registro foi encontrados"));}