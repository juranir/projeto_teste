<?php
session_start();

if(!isset($_SESSION['logado'])):
	header("Location: index.php");
endif;

$abrirModal =  $_COOKIE["openModal"];
//?>

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

	a.log_hover:hover{
		color: #cc6600;
	}

	#page_div {
    	position: relative;
    	margin: 0px 0 0 240px;
    	transition: 0.2s ease-out;
    	padding-top: 50px;
	}

</style>




<body onload="espera_abrir_popup()">
		


<?php include ("_topbar.php"); ?>

<?php include ("_menulateral.php"); ?>


<div style="padding-left: 240px;min-height: 900px;min-width: 600px;" class="fundo">
	<div class="container-fluid" style="padding-top: 50px;">		
		<div id="conteudo" class="container" style="padding-top: 10px;">
		</div>
	</div>
</div>


<!--POP_UP - Cadastro de e-mail-->
<!-- Button trigger modal -->
<button hidden id="openModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">

</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Deseja receber os últimos posts por e-mail? <br>Cadastre-se.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="email/processa_cadastro_email.php" method="POST">
                    <p><input type="email" name="email" placeholder="Informe o e-mail que deseja cadastrar." required style="border: 1px solid gray"></p>
                    <br>
                    <p><button type="submit" class="btn btn-primary">Cadastrar</button></p>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

    <?php include ("_js.php"); ?>

<footer>

	<script type="text/javascript">

		function carrega(pagina){

			$("#conteudo").load(pagina);
		}

        function abrir() {
            var _abrirModal  = "<?php print $abrirModal ; ?>";

            if (_abrirModal != 'False') {
                document.getElementById('openModal').click();
            }

            document.cookie="openModal=False";
        }
        function espera_abrir_popup() {
            setTimeout("abrir()", 3000)
        }
    </script>

</footer>
</html>