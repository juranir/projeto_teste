<?php
require '../db/conexaopdo.php';


$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';


if (empty($termo)){

    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status, foto FROM clientes';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $clientes = $stm->fetchAll(PDO::FETCH_OBJ);

}else {


    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status, foto FROM clientes WHERE nome LIKE :nome OR email LIKE :email';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':nome', $termo . '%');
    $stm->bindValue(':email', $termo . '%');
    $stm->execute();
    $clientes = $stm->fetchAll(PDO::FETCH_OBJ);

};
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listagem de Clientes</title>
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
<div class='container'>
    <fieldset>


        <legend><h1>Listagem de Clientes</h1></legend>


        <form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
            <label class="col-md-2 control-label" for="termo">Pesquisar</label>
            <div class='col-md-7'>
                <input type="text" class="form-control" id="termo" name="termo" placeholder="Infome o Nome ou E-mail">
            </div>
            <button type="submit" class="btn btn-primary">Pesquisar</button>
            <a onclick="carrega('listarClientes.php')" href="#" class="btn btn-primary">Ver Todos</a>
        </form>

        <?php if(!empty($clientes)){?>


            <table class="table table-striped">
                <tr class='active'>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                <?php foreach($clientes as $cliente){?>
                    <tr>
                        <td><img src='../fotos/<?=$cliente->foto?>' height='40' width='40'></td>
                        <td><?=$cliente->nome?></td>
                        <td><?=$cliente->email?></td>
                        <td><?=$cliente->celular?></td>
                        <td><?=$cliente->status?></td>
                        <td>
                            <a href='editarClientes.php?id=<?=$cliente->id?>' class="btn btn-primary">Editar</a>
                            <a href='javascript:void(0)' class="btn btn-danger link_exclusao" rel="<?=$cliente->id?>">Excluir</a>
                        </td>
                    </tr>
                <?php };?>
            </table>

        <?php }else{ ?>


            <h3 class="text-center text-primary">Não existem clientes cadastrados!</h3>
        <?php }; ?>
    </fieldset>
</div>
<script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>