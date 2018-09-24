	
<!DOCTYPE html>
<html lang="pt-br">
<body>
  <style>

  a.log_hover:hover{
    color: #cc6600;
  }

  </style>

    <div class="navbar-default sidebar nicescroll" role="navigation" tabindex="5000" style="overflow: hidden; outline: none;">
            <div class="sidebar-nav navbar-collapse">
                <ul class="" id="side-menu">

                    <li class="nav-small-cap">Menu</li>                    
                    <li><a href="pagina_inicial.php" class="waves-effect"> Inicio</a></li>

                    <li><a class="waves-effect" data-toggle="collapse" href="#cadastros"><i class="fa fa-pencil-square-o"></i>  Cadastros<span class="fa arrow"></span></a>
                        <div id="cadastros" class="panel-collapse collapse">
                          <ul class="nav nav-second-level" style="height: 1px;">
                              <li><a onclick="carrega('cadastrarUsuario.php')" href="#"><i class="fa fa-user"></i> &nbsp Cadastro de Usuários</a></li>
                              <li><a onclick="carrega('cadastrarCliente.php')" href="#"><i class="fa fa-user"></i> &nbsp Cadastro de Clientes</a></li>
                              <li><a onclick="carrega('cadastrarFuncao.php')" href="#"><i class="fa fa-user"></i> &nbsp Cadastro de Função</a></li>
                          </ul>
                        </div>                        
                    </li>


                    <li class=""><a href="" class="waves-effect"></a>
                      <div style="height: 50px">
                      </div>
                    </li>

                    <li><a class="waves-effect" data-toggle="collapse" href="#relatorios"><i class="fa fa-file-text-o"></i> Relatórios<span class="fa arrow"></span></a>
                        <div id="relatorios" class="panel-collapse collapse">
                            <ul class="nav nav-second-level" style="height: 1px;">
                                <li> <a onclick="carrega('listarClientes.php')" href="#"><i class="fa fa-files-o"></i> &nbsp Listar Clientes</a> </li>
                          </ul>
                      </div>
                    </li>



                </ul>
            </div>
        </div>


</body>
    
</html>