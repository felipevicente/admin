<?php
require_once '../../app/control/Sessao.php';
$sessao = new Sessao();
$sessao->logado(); //VERIFICA SE O USUARIO ESTÁ LOGADO

require_once 'Usuario.php';

$usuario = new Usuario();

$editar = isset($_GET['editar']) ? (int) $_GET['editar'] : null;

if (isset($_POST['btn_salvar'])){ //CADASTRAR USUARIO
  $usuario->cadastrarUsuario($_POST);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VCT Solution - Cadastro de Usuários</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
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
        Cadastro de Usuário
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active"><a href="listar_usuario.php"> Usuários</a></li>
        <li class="active">Cadastro de Usuário</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box">
            <div class="box-body">
              <form method="POST" action="cadastar_usuario.php" id="form_usuario" role="form">
                <?php
                    if (empty($editar)) {
                      echo $usuario->novoUsuario(); // NOVO USUARIO
                    } else {
                      echo $usuario->editarUsuario($editar); //EDITAR USUARIO
                    }
                ?>
                <div class="box-footer">
                  <div class="col-md-12">
                    <button type="submit" name="btn_salvar" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>
                    <a href="listar_usuario.php" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                  </div>
                </div>
              </form>
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
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../bower_components/fastclick/app/fastclick.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/demo.js"></script>
<script src="../../dist/js/geral.js"></script>
</body>
</html>
