<?php
//session_start();
include_once('../db/conexao.php');
$conn = Conexao::getInstance();

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

$sql_email = "INSERT INTO newsletter_email (email) VALUES ('$email')";
$resultado_email = mysqli_query($conn, $sql_email);

// VERIFICAR COM MARCOS COMO VERIFICAR SE UM ÍTEM FOI INSERIDO NO BANCO

//Após tentar inserir, exibe uma mensagem de sucesso ou erro via alert
//if (mysqli_insert_id($conn) != 0) {
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;'><script type='text/javascript'>alert('E-mail cadastrado com sucesso.');</script>";
    ?>
    <!doctype html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de E-mail</title>
    </head>
    <body onload="enviar_email();">
    <form id="form" action="enviar_email.php" method="POST">
        <p>Enviando e-mail ...</p>
        <input type="hidden" name="addAddress" value="<?php echo $email; ?>">
        <input type="hidden" name="Subject" value="Bem vindo ao nosso site.">
        <input type="hidden" name="Message" value="<h2>Agradecemos por se cadastrar.</h2> <br /> <p>A partir de agora você receberá as nossas atualizações.</p>">
        <input type="hidden" name="IsHTML" value="True">
    </form>
    </body>
    <script type="text/javascript"> function enviar_email() {
            document.getElementById('form').submit()
        }</script>
    </html>

<?php
//} else {
//    $_SESSION['msg'] = "<p style='color:red;'></p>";
//    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0; URL=/trabalho_Juranir/pagina_inicial.php'><script type='text/javascript'>alert('Erro ao cadastrar o e-mail.');</script>";
//}
