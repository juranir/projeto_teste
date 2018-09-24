<?php

session_start();

require 'db/conexao.php';

$conn = Conexao::getInstance();

// Recebe os dados do formulario
if(isset($_POST['login']))
{ $login = $_POST['login']; }
else
{ $login = ''; };

if(isset($_POST['senha']))
{ $senha = $_POST['senha'];}
else
{ $senha = ''; };


// // Validações
// if (empty($login)){
// 	$retorno = array('codigo' => 0, 'mensagem' => 'Preencha seu login!'.$login);
// 	echo json_encode($retorno);
// 	exit();
// }

// if (empty($senha)){
//	$retorno = array('codigo' => 0, 'mensagem' => 'Preencha sua senha!'.$senha);
// 	echo json_encode($retorno);
// 	exit();
// }


//metodo de criptografia( deve ser inserido no cadastro do usuario)
// metodo seguro e simples sem complicação
$senha =  sha1($senha);


// Validação do usuário/senha digitados
  $sql = "SELECT * FROM usuario WHERE login = '".$login."' and senha = '".$senha."' LIMIT 1";
    $query = mysqli_query($conn,$sql);
  if (mysqli_num_rows($query) != 1) {
      // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
  	  // Não permite o login
      $retorno = array('codigo' => 0, 'mensagem' => 'Login inválido!');
      echo json_encode($retorno);

      $_SESSION['logado'] = 'NAO'; 
      exit();
  } else {
      // Salva os dados encontados na variável $resultado
  	  // Libera o login
      $retorno = mysqli_fetch_assoc($query);
      $_SESSION['logado'] = 'SIM';
  }



// Se logado envia código 1, senão retorna mensagem de erro para o login
if ($_SESSION['logado'] == 'SIM'){
	$retorno = array('codigo' => 1, 'mensagem' => 'Logado com sucesso!');
	echo json_encode($retorno);
	exit();
}else{
	$retorno = array('codigo' => 0, 'mensagem' => 'Usuário não autorizado!');
	echo json_encode($retorno);
	exit();	
}