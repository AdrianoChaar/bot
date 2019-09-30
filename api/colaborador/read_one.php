<?php
	header("Access-Control-Allow-Origin: *"); 	header("Access-Control-Allow-Headers: access"); 	header("Access-Control-Allow-Methods: GET"); header("Access-Control-Allow-Credentials: true"); header('Content-Type: application/json');
	include_once '../config/database.php'; include_once '../objetos/colaborador.php';
	$database=new Database(); $db=$database->getConnection(); $colaborador=new Colaborador($db); $colaborador->id=isset($_GET['id']) ? $_GET['id'] : die(); $colaborador->readOne();
	if($colaborador->nome!=null){
		$colaborador_arr=array("id"=> $colaborador->id, "nome"=>$colaborador->nome, "login"=>$colaborador->login, "senha"=>$colaborador->senha);
		http_response_code(200); echo json_encode($colaborador_arr);}
	else{http_response_code(404); echo json_encode(array("message"=>"Registro não foi encontrado no banco de dados"));}