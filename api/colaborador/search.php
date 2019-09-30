<?php
	header("Access-Control-Allow-Origin: *"); header("Content-Type: application/json; charset=UTF-8"); include_once '../config/core.php'; include_once '../config/database.php'; include_once '../objetos/colaborador.php';
	$database=new Database(); $db=$database->getConnection(); $colaborador=new Colaborador($db); $keywords=isset($_GET["s"]) ? $_GET["s"] : "";
	$stmt=$colaborador->search($keywords); $num=$stmt->rowCount();
	if($num>0){
		$colaborador_arr=array(); $colaborador_arr["registros"]=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){extract($row);
			$colaborador_item=array("nome"=>$nome,	"login"=>html_entity_decode($login), "senha"=>$senha);
			array_push($colaborador_arr["registros"], $colaborador_item);}
		http_response_code(200); echo json_encode($colaborador_arr);}
	else{http_response_code(404); echo json_encode(array("mensagem" => "Nenhum registro foi encontrado"));}