<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sistema de Cadastro</title>
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
<div class='container box-mensagem-crud'>
    <?php
    require '../db/conexaopdo.php';


    $conexao = conexao::getInstance();


    $acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
    $id    = (isset($_POST['id'])) ? $_POST['id'] : '';
    $nome  = (isset($_POST['nome'])) ? $_POST['nome'] : '';
    $cpf   = (isset($_POST['cpf'])) ? str_replace(array('.','-'), '', $_POST['cpf']): '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $foto_atual		  = (isset($_POST['foto_atual'])) ? $_POST['foto_atual'] : '';
    $data_nascimento  = (isset($_POST['data_nascimento'])) ? $_POST['data_nascimento'] : '';
    $telefone  		  = (isset($_POST['telefone'])) ? str_replace(array('-', ' '), '', $_POST['telefone']) : '';
    $celular   		  = (isset($_POST['celular'])) ? str_replace(array('-', ' '), '', $_POST['celular']) : '';
    $status    		  = (isset($_POST['status'])) ? $_POST['status'] : '';



    $mensagem = '';
    if ($acao == 'editar' && $id == '') {
        $mensagem .= '<li>ID do registros desconhecido.</li>';
    };


    if ($acao != 'excluir') {
        if ($nome == '' || strlen($nome) < 3) {
            $mensagem .= '<li>Favor preencher o Nome.</li>';
        };

        if ($cpf == '') {
            $mensagem .= '<li>Favor preencher o CPF.</li>';
        } elseif (strlen($cpf) < 11) {
            $mensagem .= '<li>Formato do CPF inválido.</li>';
        };

        if ($email == '') {
            $mensagem .= '<li>Favor preencher o E-mail.</li>';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensagem .= '<li>Formato do E-mail inválido.</li>';
        };

        if ($data_nascimento == '') {
            $mensagem .= '<li>Favor preencher a Data de Nascimento.</li>';
        } else {
            $data = explode('/', $data_nascimento);
        }
        if (!checkdate($data[1], $data[0], $data[2])) {
            $mensagem .= '<li>Formato da Data de Nascimento inválido.</li>';
        };


        if ($telefone == '') {
            $mensagem .= '<li>Favor preencher o Telefone.</li>';
        } elseif (strlen($telefone) < 10) {
            $mensagem .= '<li>Formato do Telefone inválido.</li>';
        };

        if ($celular == '') {
            $mensagem .= '<li>Favor preencher o Celular.</li>';
        } elseif (strlen($celular) < 11) {
            $mensagem .= '<li>Formato do Celular inválido.</li>';
        };

        if ($status == '') {
            $mensagem .= '<li>Favor preencher o Status.</li>';
        };

        if ($mensagem != '') {
            $mensagem = '<ul>' . $mensagem . '</ul>';
            echo "<div class='alert alert-danger' role='alert'>" . $mensagem . "</div> ";
            exit;
        };


        $data_temp = explode('/', $data_nascimento);
        $data_ansi = $data_temp[2] . '/' . $data_temp[1] . '/' . $data_temp[0];
    };




    if ($acao == 'incluir') {

        $nome_foto = 'padrao.jpg';
        if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {

            $extensoes_aceitas = array('bmp', 'png', 'svg', 'jpeg', 'jpg');
            $extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));


            if (array_search($extensao, $extensoes_aceitas) === false) {
                echo "<h1>Extensão Inválida!</h1>";
                exit;
            };


            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {


                if (!file_exists("fotos")) {
                    mkdir("fotos");
                };


                $nome_foto = date('dmY') . '_' . $_FILES['foto']['name'];


                if (!move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/' . $nome_foto)) {
                    echo "Houve um erro ao gravar arquivo na pasta de destino!";
                };
            };
        };

        $sql = 'INSERT INTO clientes (nome, email, cpf, data_nascimento, telefone, celular, status, foto)
							   VALUES(:nome, :email, :cpf, :data_nascimento, :telefone, :celular, :status, :foto)';

        $stm = $conexao->prepare($sql);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':cpf', $cpf);
        $stm->bindValue(':data_nascimento', $data_ansi);
        $stm->bindValue(':telefone', $telefone);
        $stm->bindValue(':celular', $celular);
        $stm->bindValue(':status', $status);
        $stm->bindValue(':foto', $nome_foto);
        $retorno = $stm->execute();

        if ($retorno) {
            echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
        };

        echo "<meta http-equiv=refresh content='3;URL=../paginas/listarClientes.php'>";
    };



    if ($acao == 'editar') {

        if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {


            if ($foto_atual <> 'padrao.jpg') {
                unlink("fotos/" . $foto_atual);
            };

            $extensoes_aceitas = array('bmp', 'png', 'svg', 'jpeg', 'jpg');
            $extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));


            if (array_search($extensao, $extensoes_aceitas) === false) {
                echo "<h1>Extensão Inválida!</h1>";
                exit;
            };


            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {


                if (!file_exists("fotos")) {
                    mkdir("fotos");
                };


                $nome_foto = date('dmY') . '_' . $_FILES['foto']['name'];


                if (!move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/' . $nome_foto)) {
                    echo "Houve um erro ao gravar arquivo na pasta de destino!";
                };
            };
        } else {

            $nome_foto = $foto_atual;

        };

        $sql = 'UPDATE clientes SET nome=:nome, email=:email, cpf=:cpf, data_nascimento=:data_nascimento, telefone=:telefone, celular=:celular, status=:status, foto=:foto ';
        $sql .= 'WHERE id = :id';

        $stm = $conexao->prepare($sql);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':cpf', $cpf);
        $stm->bindValue(':data_nascimento', $data_ansi);
        $stm->bindValue(':telefone', $telefone);
        $stm->bindValue(':celular', $celular);
        $stm->bindValue(':status', $status);
        $stm->bindValue(':foto', $nome_foto);
        $stm->bindValue(':id', $id);
        $retorno = $stm->execute();

        if ($retorno) {
            echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div> ";
        }else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div> ";
        };

        echo "<meta http-equiv=refresh content='3;URL=../paginas/listarClientes.php'>";
    };



    if ($acao == 'excluir') {


        $sql = "SELECT foto FROM clientes WHERE id = :id AND foto <> 'padrao.jpg'";
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();
        $cliente = $stm->fetch(PDO::FETCH_OBJ);

        if (!empty($cliente) && file_exists('fotos/' . $cliente->foto)) {
            unlink("fotos/" . $cliente->foto);
        };


        $sql = 'DELETE FROM clientes WHERE id = :id';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id);
        $retorno = $stm->execute();

        if ($retorno) {
            echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
        };

        echo "<meta http-equiv=refresh content='3;URL=../paginas/listarClientes.php'>";
    };
    ?>

</div>
</body>
</html>
