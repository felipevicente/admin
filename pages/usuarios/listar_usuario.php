<?php

require_once '../../app/control/Sessao.php';
$sessao = new Sessao();
$sessao->logado(); //VERIFICA SE O USUARIO ESTÁ LOGADO

require_once 'Usuario.php';

$usuario = new Usuario();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VCT Solution - Lista de Usuários</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php
  include("../menu/header.php"); //MENU TOP
  include("../menu/menu.php"); //MENU PRINCIPAL
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Usuários
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active"><a href="listar_usuario.php"> Usuários</a></li>
        <li class="active">Lista de Usuários</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box">
            <div class="box-header">
              <div class="row mg-bottom">
                <div class="col-md-6">
                    <a href="cadastar_usuario.php" id="btn_adicionar" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar Usuário</a>
                    <a href="#" id="btn_grupo_usuario" class="btn btn-warning"><span class="fa fa-sitemap"></span> Grupo de Usuários</a>
                </div>
                <div class="col-md-6">
                    <form action="listar_usuario.php" id="busca_simples" role="search" method="get" accept-charset="utf-8" novalidate="novalidate">
                      <div class="input-group">
                        <input type="hidden" name="busca_simples" value="true" autocomplete="off" id="busca_simples">
                        <input name="busca" id="ipt_busca_simples" placeholder="Busca Rápida" class="form-control" maxlength="100" autocomplete="off" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary mg-right" type="submit"><i class="fa fa-search"></i></button>
                            <button class="btn btn-primary" id="btn_busca_avancada" type="button">
                              <span class="visible-xs"><i class="fa fa-search-plus" data-toggle="tooltip" data-placement="left" data-original-title="Busca avançada"></i></span>
                              <span class="hidden-xs"><i class="fa fa-search-plus" id="icon_busca"></i> Busca avançada</span>
                            </button>
                        </div>
                      </div>
                    </form>
                </div>
              </div>
              <div class="row dis-none" id="div_form_busca_avancada">
                  <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="col-sm-12 col-lg-12 col-md-12 well well-sm">
                      <form action="listar_usuario.php" id="busca-avancada" role="search" method="get" accept-charset="utf-8" novalidate="novalidate">
                        <input type="hidden" name="busca_avancada" value="true" autocomplete="off" id="opt_busca_avancada">
                        <div class="form-group col-sm-4 col-lg-4 col-md-4">
                            <label for="PesquisarPor">Pesquisar por</label>
                            <select name="tipo_busca" class="form-control" autocomplete="off" id="tipo_busca">
                            <option value="id_usuario">Código</option>
                            <option value="nome">Nome</option>
                            <option value="ativo">Ativo</option>
                            <option value="email">Email</option>
                            <option value"telefone" >Telefone</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-8 col-lg-8 col-md-8">
                          <label for="Descricao">Descrição</label>
                          <input id="ipt_busca_avancada" name="busca" placeholder="Descrição" class="form-control" value="" maxlength="100" autocomplete="off" type="text">
                        </div>
                        <div class="both col-sm-12 col-lg-12 col-md-12">
                          <button class="btn btn-primary" type="submit"><span class="fa fa-search"></span> Buscar</button>
                          <button type="reset" id="reset-form" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Limpar</button>
                        </div>
                      </form>
                      </div>
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tb_lista_usuario" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Nome / Sobre Nome</th>
                  <th>Ativo</th>
                  <th>Email</th>
                  <th>Telefone</th>
                  <th>Data Cadastro</th>
                  <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    switch ($_GET) {
                      case $_GET == 0: //SEM GET
                        $usuario->listarUsuario();
                        break;
                      case isset($_GET['busca_simples']) == true: //BUSCA SIMPLES
                        $usuario->buscaSimplesUsuario($_GET['busca']);
                        break;
                      case  isset($_GET['busca_avancada']) == true: //BUSCA AVANÇADA
                        $usuario->buscaAvancadaUsuario($_GET);
                        break;
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php
  include("../menu/footer.php"); //MENU TOP
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/demo.js"></script>
<script src="usuario.js"></script>

</body>
</html>