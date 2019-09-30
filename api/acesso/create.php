<?php
	header("Access-Control-Allow-Origin: *"); header("Content-Type: application/json; charset=UTF-8"); header("Access-Control-Allow-Methods: POST"); header("Access-Control-Max-Age: 3600");	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once '../config/database.php'; include_once '../objetos/acesso.php';
	$database=new Database(); $db=$database->getConnection(); $acesso=new Acesso($db); $data=json_decode(file_get_contents("php://input"));
	if(!empty($data->user_id) && !empty($data->entrada) && !empty($data->dt_entrada) && !empty($data->hr_entrada)){
		$acesso->user_id=$data->user_id; $acesso->entrada=$data->entrada; $acesso->dt_entrada=$data->dt_entrada;$acesso->hr_entrada=$data->hr_entrada;
		if($acesso->create()){http_response_code(201); echo json_encode(array("mensagem"=>"Novo registro foi criado com sucesso"));}
		else{http_response_code(503); echo json_encode(array("mensagem"=>"Erro - Não foi possível criar o registro"));}	}
	else{http_response_code(400); echo json_encode(array("mensagem"=>"Informação incompleta"));}