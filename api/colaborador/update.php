<?php
	header("Access-Control-Allow-Origin: *"); header("Content-Type: application/json; charset=UTF-8"); header("Access-Control-Allow-Methods: POST"); header("Access-Control-Max-Age: 3600"); header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once '../config/database.php'; include_once '../objetos/colaborador.php';
	$database=new Database(); $db=$database->getConnection(); $colaborador=new Colaborador($db); $data=json_decode(file_get_contents("php://input"));
	$colaborador->id=$data->id; $colaborador->nome=$data->nome; $colaborador->login=$data->login; $colaborador->senha=$data->senha; 
	if($colaborador->update()){http_response_code(200); echo json_encode(array("mensagem" => "Registro foi atualizado com sucesso"));}
	else{http_response_code(503); echo json_encode(array("mensagem" => "Erro - Não foi possível atualizar o registro"));}