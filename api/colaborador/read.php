<?php
	$_POST['ordem']=(isset($_POST['ordem'])) ? $_POST['ordem']:1; $_POST['campo']=(isset($_POST['campo'])) ? $_POST['campo']:'id'; $SortCmp=$_POST["campo"]; $SortOrder=$_POST["ordem"]; 
	header("Access-Control-Allow-Origin: *"); header("Content-Type: application/json; charset=UTF-8"); include_once '../config/database.php'; include_once '../objetos/colaborador.php';
 	$database=new Database(); $db=$database->getConnection(); $colaborador=new Colaborador($db); $stmt=$colaborador->read(); $num=$stmt->rowCount();
	if($num>0){$colaborador_arr=array(); $colaborador_arr["registros"]=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){extract($row); 
			$colaborador_item=array("id"=>$id, "nome"=>html_entity_decode($nome), "login"=>html_entity_decode($login), "senha"=>$senha);
			array_push($colaborador_arr["registros"], $colaborador_item);}
		$SortArr=array_column($colaborador_arr["registros"], $SortCmp); 
		if($SortOrder==1){array_multisort($SortArr, SORT_ASC, $colaborador_arr["registros"]);}
		else if($SortOrder==0){array_multisort($SortArr, SORT_DESC, $colaborador_arr["registros"]);}
		else{array_multisort($SortArr, SORT_ASC, $colaborador_arr["registros"]);}
		http_response_code(200); echo json_encode($colaborador_arr);}
	else{http_response_code(404); echo json_encode(array("mensagem" => "Nenhum registro foi encontrado"));}