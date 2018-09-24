<?php
require '../db/conexaopdo.php';


$id_cliente = (isset($_GET['id'])) ? $_GET['id'] : '';


if (!empty($id_cliente) && is_numeric($id_cliente)) {


    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, cpf, data_nascimento, telefone, celular, status, foto FROM clientes WHERE id = :id';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':id', $id_cliente);
    $stm->execute();
    $cliente = $stm->fetch(PDO::FETCH_OBJ);

    if (!empty($cliente)) {


        $array_data = explode('-', $cliente->data_nascimento);
        $data_formatada = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];

    };

};

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edição de Cliente</title>

    <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
<div class='container'>
    <fieldset>
        <legend><h1>Formulário - Edição de Cliente</h1></legend>

        <?php if(empty($cliente)){?>
            <h3 class="text-center text-danger">Cliente não encontrado!</h3>
        <?php} else{ ?>
            <form action="action_cliente.php" method="post" id='form-contato' enctype='multipart/form-data'>
                <div class="row">
                    <label for="nome">Alterar Foto</label>
                    <div class="col-md-2">
                        <a href="#" class="thumbnail">
                            <img src="../fotos/<?=$cliente->foto?>" height="190" width="150" id="foto-cliente">
                        </a>
                    </div>
                    <input type="file" name="foto" id="foto" value="foto" >
                </div>

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?=$cliente->nome?>" placeholder="Infome o Nome">
                    <span class='msg-erro msg-nome'></span>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=$cliente->email?>" placeholder="Informe o E-mail">
                    <span class='msg-erro msg-email'></span>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" value="<?=$cliente->cpf?>" placeholder="Informe o CPF">
                    <span class='msg-erro msg-cpf'></span>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="data_nascimento" class="form-control" id="data_nascimento" maxlength="10" value="<?=$data_formatada?>" name="data_nascimento">
                    <span class='msg-erro msg-data'></span>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" value="<?=$cliente->telefone?>" placeholder="Informe o Telefone">
                    <span class='msg-erro msg-telefone'></span>
                </div>
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" value="<?=$cliente->celular?>" placeholder="Informe o Celular">
                    <span class='msg-erro msg-celular'></span>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="<?=$cliente->status?>"><?=$cliente->status?></option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                    <span class='msg-erro msg-status'></span>
                </div>

                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="id" value="<?=$cliente->id?>">
                <input type="hidden" name="foto_atual" value="<?=$cliente->foto?>">
                <button type="submit" class="btn btn-primary" id='botao'>
                    Gravar
                </button>
                <a href='listarClientes.php' class="btn btn-danger">Cancelar</a>
            </form>
        <?php }; ?>
    </fieldset>

</div>
<script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>