<?php
	
	session_start();


	if(isset($_SESSION['logado']) && $_SESSION['logado'] == 'SIM'):
		header("Location: paginas/pagina_inicial.php");
	endif;

?>

<!DOCTYPE html>

<html lang="pt-br">

<?php include ("_head.php"); ?>

<style>

	.fundo{
		background-image: url(../images/fundo_tec.png);
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
	}

</style>

<body>

	<div class="limiter">
		<div class="container-login100 fundo" >
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(../images/logobarba4.png);">					
				</div>
				<form id="form_login" class="login100-form validate-form" metod="POST">
					<div class="wrap-input100 validate-input m-b-26" data-validate="O Login é obrigatório">
						<span class="label-input100">Login</span>
						<input class="input100" type="text" name="login" placeholder="Informe o usuário">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "A senha é obrigatória">
						<span class="label-input100">Senha</span>
						<input class="input100" type="password" name="senha" placeholder="Informe a senha" autocomplete="">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">

						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Permanecer conectado								
							</label>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button id="btn_login" class="login100-form-btn">
							Entrar
						</button>
					</div>
					
					<div class="row" style="width: 100%; height: 20px;"></div>				
					<div id="alerta" class="alert alert-danger" style="width: 100%;display: none;">
						<div id="msg"></div>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>

<?php include ("_js.php"); ?>
	
<script>

$('document').ready(function(){


	$("#btn_login").click(function(){
		
		// impede o sumit do formulário -->
		event.preventDefault();

		var data = $("#form_login").serialize();


		$.ajax({
			type : "POST",
			url  : '../login.php',
			data : data,
			dataType: 'json',
			beforeSend: function()
			{	
				$("#btn_login").html('Validando ...');
			},
			success : function(resposta){						
				if(resposta.codigo == "1"){					
					$("#btn_login").html('Entrar');					
					window.location.href = "pagina_inicial.php";
					$("#alerta").html(resposta.mensagem);
					$("#alerta").css("display","block");
				}
				else{								
					
					$("#btn_login").html('Entrar');
					$("#alerta").html(resposta.mensagem);
					$("#alerta").css("display","block");
					
					
					
				}
		    }

		});



	});

});

</script>



</html>