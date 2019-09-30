/* Variáveis */
var usr_Name=""; var usr_ID=""; var usr_Passwd=""; var IDUsuario=""; var TP_entrada=0; var Criterio=""; var msgHelp=function(){botui.message.bot({delay:1500, content:'como eu posso te ajudar?'});}	

/* Função Main */
var botui=new BotUI('delivery-bot');
botui.message.add({content: '🤖 - Oi, eu sou o Drico, chatbot de atendimento desta página'}); botui.message.bot('como eu posso te ajudar?')
	.then(function(){
		if(sessionStorage.getItem('logStatus')==0){
			return botui.action.button({delay:1000, addMessage:false, action:[{text:'Sou novo aqui', value:'OPC1'}, {text:'Login', value:'OPC2'}]})
			.then(function(res){if(res.value=='OPC1'){fn_NovoAqui();}else if(res.value=='OPC2'){fn_Login();}})			
		}
	})
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* Função fn_NovoAqui() */
var fn_NovoAqui=function(){
	if(sessionStorage.getItem('logStatus')==0){
		botui.message.human({delay:500, content:"Sou novo aqui"}); 
		botui.message.add({delay:1000, content:'Que legal, seja bem vindo aqui no nosso chat ❤'}); 
		botui.message.add({delay:1000, content:'Temos muito conteúdo pra você, da uma olhada aqui!'}); 
		botui.message.add({delay:1000, type:'embed', content:'https://www.youtube.com/embed/TPONzG15vVY'}); msgHelp(); 
		botui.action.button({delay:2000, addMessage:false, action:[{text:'Quero me cadastrar', value:'OPC1'},{text:'Finalizar', value:'OPC2'}]})
		.then(function(res){if(res.value=='OPC1'){fn_Cadastrar();}else if(res.value=='OPC2'){document.location.reload(true);}})
	}
	else{
		botui.message.human({delay:500, content:"Sou novo aqui"}); 
		botui.message.add({delay:1000, content:'Temos muito conteúdo pra você, da uma olhada aqui!'}); 
		botui.message.add({delay:1000, type:'embed', content:'https://www.youtube.com/embed/iLuB5iPnR54'});
		botui.message.add({delay:1000, type:'embed', content:'https://www.youtube.com/embed/Ahd9bOQ9KF8'});
		botui.message.add({delay:1000, type:'embed', content:'https://www.youtube.com/embed/G8Fa8oVnakM'}); msgHelp(); 
		botui.action.button({delay:2000, addMessage:false, action:[{text:'Check-In/Check-Out', value:'OPC1'},{text:'Finalizar', value:'OPC2'}]})
		.then(function(res){if(res.value=='OPC1'){fn_MarcarHorario();}else if(res.value=='OPC2'){document.location.reload(true);}})
	}
}	
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* Função fn_Cadastrar() */
var fn_Cadastrar=function(){
	botui.message.human({delay:100, content:"Cadastrar"}); 
	botui.message.bot({delay:500, loading:false, content:'Entre com os dados pedidos para fazer o seu cadastro, e tecle [ENTER] para continuar'})
	botui.action.text({addMessage:true, delay:750, action:{size:50, icon:'angle-double-right', value:usr_Name, placeholder:'Nome completo'}})
		.then(function(res){usr_Name=res.value; var primeiroNome=usr_Name.split(' ')[0]; var nomeMin=primeiroNome.toLowerCase();
			botui.action.text({addMessage:true, delay:750, action:{size:50, icon:'angle-double-right', value:usr_ID, placeholder:'Identificação (Ex: '+nomeMin+')'}})
				.then(function(res){usr_ID=res.value;
					botui.action.text({addMessage:false, action:{size:50, icon:'angle-double-right', value:usr_Passwd, placeholder:'Senha', sub_type:'password'}})
						.then(function(res){usr_Passwd=res.value;
							botui.message.add({loading:true})
								.then(function(index){
										var formData=JSON.stringify({"nome":usr_Name, "login":usr_ID, "senha":usr_Passwd});
										$.ajax({type:"POST", url:"api/colaborador/create.php", data:formData, cache:false, 
										beforeSend:function(Status){},
										success:function(Data){						
											sessionStorage.setItem('logStatus', 1);
											botui.message.update(index,{loading:false, content:'Olá '+usr_ID+", você acabou de se registrar com sucesso"});
											botui.action.button({delay:2000, addMessage:false, action:[{text:'Voltar', value:'OPC1'}]})
											.then(function(res){if(res.value=='OPC1'){document.location.reload(true);}})
										},
										error: function(jqXHR, textStatus, errorThrown){if (jqXHR.status==500){alert('Internal error: '+jqXHR.responseText);}else{alert('Error code: '+jqXHR.status);}}
									});
								})
						})
				})
		})
}	
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* Função fn_Login()) */
var fn_Login=function(){
	botui.message.human({delay:100, content:"Login"}); 
	botui.message.bot({delay:500, loading:false, content:'Entre com os dados pedidos para fazer o login, e tecle [ENTER] para continuar'})
	botui.action.text({addMessage:true, delay:750, action:{size:30, icon:'angle-double-right', value:usr_ID, placeholder:'Identificação'}})
	.then(function(res){usr_ID=res.value;
		botui.action.text({addMessage:false, action:{size:30, icon:'angle-double-right', value:usr_Passwd, placeholder:'Senha', sub_type:'password'}})
		.then(function(res){usr_Passwd=res.value;
			botui.message.add({loading:true})
			.then(function(index){
				$Criterio="s="+usr_ID+"|"+usr_Passwd;
				$.ajax({type:"GET", url:"api/colaborador/login.php", data: $Criterio, cache:false, 
					beforeSend:function(Status){},
					success:function(Data){
						IDUsuario=Data['registros'][0]['id'];
						botui.message.update(index,{loading:false, content:'Olá '+Data['registros'][0]['login']+", você foi autenticado no chat"}); msgHelp();
						botui.action.button({delay:2000, addMessage:false, action:[{text:'Check-In/Check-Out', value:'OPC1'},{text:'Ver Marcações', value:'OPC2'}, {text:'Finalizar', value:'OPC3'}]})
						.then(function(res){if(res.value=='OPC1'){sessionStorage.setItem('logStatus',1); fn_MarcarHorario();}
						else if(res.value=='OPC2'){fn_MostrarRegistros();}else if(res.value=='OPC3'){document.location.reload(true);}
					})
					},
					error:function(jqXHR, textStatus, errorThrown){
						botui.message.update(index,{delay:2000, loading:false, content:'Dados de acesso incorretos'});
						botui.action.button({delay:2000, addMessage:false, action:[{text:'Finalizar', value:'OPC1'}]})
						.then(function(res){if(res.value=='OPC1'){document.location.reload(true);}})
						}
					});
			  });
		})
	})
}
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

var fn_MarcarHorario=function(){
	botui.message.human({delay:500, content:"Check-In/Check-Out"});
		botui.message.bot({delay:500, content:'Escolha uma das opções de marcação de horário'})
		botui.action.button({delay:2000, addMessage:false, action:[{text:'Entrada', value:'ENT'}, {text:'Ir Almoçar', value:'IDA'}, {text:'Voltar do Almoço', value:'RET'}, {text:'Saída', value:'SAI'}]})
		.then(function(res){
			if(res.value=='ENT'){botui.message.human({delay:500, content:"Entrada"});TP_entrada=1; getEntrada();}
			else if(res.value=='IDA'){botui.message.human({delay:500, content:"Saída para almoço"});TP_entrada=2; getEntrada();}
			else if(res.value=='RET'){botui.message.human({delay:500, content:"Retorno do almoço"});TP_entrada=3; getEntrada();}
			else if(res.value=='SAI'){botui.message.human({delay:500, content:"Saída"});TP_entrada=4; getEntrada();}
		})
}
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */


var getEntrada=function(){
	botui.message.bot({delay:500, content:'Tecle [ENTER] para confirmar o horário de marcação ('+getTime()+')'})
	.then(function(){return botui.action.text({delay:1000, action:{size:30, icon:'map-marker', value:getTime(), placeholder:'Horário'}})})
	.then(function(res){
		botui.message.bot({delay:500, content:'Confirma esta informação? '+res.value}); getHora=res.value;
		return botui.action.button({delay: 1000, action: [{	icon:'check', text:'Confirmar', value:'confirm'},{icon:'pencil', text:'Editar', value:'edit'}]})
	})
	.then(function(res){
		if(res.value=='confirm'){
			botui.message.bot({delay:1000, content: 'Obrigado por preencher os dados e atualizar o registro.'}); 
			botui.message.add({loading:true})
				.then(function(index){
					var formData=JSON.stringify({"user_id":IDUsuario, "entrada":TP_entrada, "dt_entrada":getDate(), "hr_entrada":getHora});
					$.ajax({type:"POST", url:"api/acesso/create.php", data:formData, cache:false, 
					beforeSend:function(Status){},
					success:function(Data){						
						botui.message.update(index,{delay:100, loading:false, content:'Você acabou de fazer um registro com sucesso'});
						botui.action.button({delay:2000, addMessage:false, action:[{text:'Check-In/Check-Out', value:'OPC1'},{text:'Logoff', value:'OPC2'}]})
						.then(function(res){if(res.value=='OPC1'){fn_MarcarHorario();}else if(res.value=='OPC2'){document.location.reload(true);}})
					},
					error: function(jqXHR, textStatus, errorThrown){if (jqXHR.status==500){alert('Internal error: '+jqXHR.responseText);}else{alert('Error code: '+jqXHR.status);}}
				});
			})
		}
		else{getEntrada();}
	});
}
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

var fn_MostrarRegistros=function(){
	botui.message.add({loading:true})
	.then(function(index){
		$Criterio="s="+IDUsuario;
		$.ajax({type:"GET", url:"api/acesso/marcacao.php", data: $Criterio, cache:false, 
			beforeSend:function(Status){},
			success:function(Data){
				botui.message.update(index,{loading:false, 
					content:Data['registros'][0]['dt_entrada']+" | "+Data['registros'][0]['hr_entrada']+"|"+Data['registros'][1]['hr_entrada']+"|"+Data['registros'][2]['hr_entrada']+"|"+Data['registros'][3]['hr_entrada']
				});
			},
			error:function(jqXHR, textStatus, errorThrown){
				botui.message.update(index,{delay:2000, loading:false, content:'Dados de acesso incorretos'});
				botui.action.button({delay:2000, addMessage:false, action:[{text:'Finalizar', value:'OPC1'}]})
				.then(function(res){if(res.value=='OPC1'){document.location.reload(true);}})
				}
			});
	  });	
}



/* Funções adicionais */
function getTime(){
	momentoAtual=new Date(); hora=momentoAtual.getHours(); minuto=momentoAtual.getMinutes(); segundo=momentoAtual.getSeconds(); 
	if(hora<10){hora="0"+hora}; if(minuto<10){minuto="0"+minuto}; if(segundo<10){segundo="0"+segundo}
	horaAtual=hora+":"+minuto+":"+segundo; return horaAtual;
}
function getDate(){
	momentoAtual=new Date(); ano=momentoAtual.getFullYear(); mes=momentoAtual.getMonth()+1; dia=momentoAtual.getDate();  
	if(dia<10){dia="0"+dia}; if(mes<10){mes="0"+mes}; 
	dataAtual=ano+"-"+mes+":"+dia; return dataAtual;
}
var end=function(){botui.message.add({delay:1000, content: 'Agradecemos o seu registro.<br />Tenha um bom dia!'});}
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
