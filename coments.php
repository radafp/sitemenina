<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Ajax with POST</title>
	
</head>
<body>
	
	
	<div id="js-newsletter">
		<h1>Cadastre seu E-mail para Newsletter (Classico não ?!)</h1>
		<p>Nome</p>
		<input type="text" name="nome" />

		<p>E-mail</p>
		<!-- Input correto neh.. pelo amor -->
		<input type="email" name="email" />
		
		<button id="btn-action">Cadastrar</button>

        
		
	</div>
	
	
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
			$( "#btn-action" ).bind( "click", function() {
				//Validação Server Side Pra que?!
				//if == null... return false e talz
			
				$.ajax({
					 url: 'testeAjax.php' //Um Classico php xD					 
					//Repare que por nenhum momento epecifiquei os parametros que precisam ser enviados..
					//apenas dei um serialize dentro de uma div que contem todos os campos
					,data: $('#js-newsletter *').serialize()
					,type:'POST'
					,dataType: 'json'
					,success: function(json){
						
						if(!json.status){
							alert(json.msg);
							return false;
						}

						//Chegou até aqui, significa que pode dar o parabens...
						alert('Cadastro efetuado');
						
						return true;
					}
					,error: function(json){
						console.log(json);
					}
				});
			});
		});
	</script>
</body>
</html>