<?php session_start(); $_SESSION["LogStatus"]=0; ?>
<!DOCTYPE html>
	<html>
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
				<title>ChatBot - AdrianoChaar.com</title>
				<link rel="stylesheet" href="https://unpkg.com/botui/build/botui.min.css" />
				<link rel="stylesheet" href="https://unpkg.com/botui/build/botui-theme-default.css" />
				<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
			<meta name="description" content="ChatBot">
		</head>
		<body>
			<div class="botui-app-container" id="delivery-bot" style="width:35%; min-width:25%; max-width:50%;">
				<bot-ui style="background-color:#CCC; padding:10px 15px;"></bot-ui>
				<div id="conteudo" style="width:100%; overflow:scroll; height:600px; background-color:#CCC; display:none;"></div><br />
				<button id="colaborador" style="display:none;">Carregar colaboradores...</button>
				<button id="acesso" style="display:none;">Carregar acessos...</button>		
			</div>
			<script src="https://cdn.jsdelivr.net/vue/latest/vue.min.js"></script>
			<script src="https://unpkg.com/botui/build/botui.js"></script>
			<script src="delivery-bot.js"></script>
			<script>
				$( "#colaborador" ).click(function(){
					$.ajax({type:"POST", url:"api/colaborador/read.php", data:"campo=nome&ordem=1", cache:false, 
						beforeSend:function(Status){},
						success:function(Data){count=0; 
							while(count<Data["registros"].length){
								document.getElementById("conteudo").innerHTML=document.getElementById("conteudo").innerHTML+Data["registros"][count]["nome"]+" | "+Data["registros"][count]["login"]+" | "+Data["registros"][count]["senha"]+"<br />";	count++;}},
						error:function(xhr){}
					});
				});
				$( "#acesso" ).click(function(){
					$.ajax({type:"POST", url:"api/acesso/read.php", data:"campo=id_usuario&ordem=1", cache:false, 
						beforeSend:function(Status){},
						success:function(Data){count=0; 
							while(count<Data["registros"].length){
								document.getElementById("conteudo").innerHTML=document.getElementById("conteudo").innerHTML+Data["registros"][count]["data"]+" | "+Data["registros"][count]["hora"]+" | "+Data["registros"][count]["tipo"]+" | "+Data["registros"][count]["id_usuario"]+"<br />";	count++;}},
						error:function(xhr){}
					});
				});				
			</script>
			<script>
				sessionStorage.setItem('logStatus', 0); 
			</script>
		</body>
	</html>