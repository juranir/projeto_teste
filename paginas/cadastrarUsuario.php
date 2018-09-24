<!doctype html>
<html lang="pt-br">


<body>

<?php include("_navbarUsuario.php"); ?>

    <div class="container">
        <form class="form-horizontal" method="post" action="../crud/cadastrarUsuario.php">
            <div class="form-group">
                <label for="nome" class="col-md-1 control-label">Nome</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                </div>
            </div>
            <div class="form-group">
                <label for="login" class="col-md-1 control-label">Login</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="login" name="login" placeholder="Login">
                </div>
            </div>
            <div class="form-group">
                <label for="senha" class="col-md-1 control-label">Senha</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                </div>
            </div>
            <div class="form-group">
                <label for="id_funcao" class="col-md-1 control-label">Função&nbspID</label>
                <div class="col-md-10">
                    <select type="text" class="form-control" id="id_funcao" name="id_funcao" placeholder="Função ID">
                        <option> Selecione a Função </option>
                        <?php
                        require("../db/conexao.php");
                        $conn = Conexao::getInstance();

                        $idfuncao = "SELECT * FROM u136429679_facul.funcao";
                        $idfuncoes = mysqli_query($conn, $idfuncao);
                        while ($todasFuncoes = mysqli_fetch_assoc($idfuncoes)){?>
                            <option value = "<?php echo $todasFuncoes['id_funcao']; ?>"><?php echo $todasFuncoes['nome_funcao'];?>
                            </option><?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-1 col-md-10">
                <input type="submit" class="btn btn-success" value="Cadastrar">
                <button type="reset" class="btn btn-danger">Limpar</button>
                </div>
            </div>
        </form>
    </div>

</body>

<?php include ("_js.php"); ?>

</html>