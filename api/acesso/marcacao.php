<?php
    header("Access-Control-Allow-Origin: *"); header("Content-Type: application/json; charset=UTF-8"); 
    include_once '../config/core.php'; include_once '../config/database.php'; include_once '../objetos/acesso.php';
    $database=new Database(); $db=$database->getConnection(); $acesso=new Acesso($db); 
    $keywords=isset($_GET["s"]) ? $_GET["s"] : ""; $stmt=$acesso->marcacao($keywords); $num=$stmt->rowCount();
	if($num>0){$acesso_arr=array(); $acesso_arr["registros"]=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){extract($row);
            $acesso_item=array("id"=>$id,"user_id"=>$user_id, "entrada"=>html_entity_decode($entrada), "dt_entrada"=>$dt_entrada, "hr_entrada"=>$hr_entrada);
            array_push($acesso_arr["registros"], $acesso_item);}
        http_response_code(200); echo json_encode($acesso_arr);}
    else{http_response_code(404); echo json_encode(array("mensagem" => "Nenhum registro foi encontrado"));}