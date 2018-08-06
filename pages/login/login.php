<?php

require_once 'Validar_login.php';

$login = new Validar_login();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VCT Solutions - Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url('../img/bg_salao5.jpg'); background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;" alt="Responsive image">
  <!-- style="background-image: url('../img/bg-login.jpg')" -->
  <!-- <img src="../img/bg-login.jpg" class="img-fluid" alt="Responsive image"> -->
<div class="login-box">
  <div class="login-logo">
    <a href="#" style="text-shadow: 2px 2px 2px #000000; color: #fff !important;"><b>VCT </b>Solutions</a>
  </div>
  <div class="login-box-body">
    <h4>Entrar no Sistema</h4>
    <form action="#" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="email" id="email" class="form-control" placeholder="Email" required="required" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="senha" class="form-control" placeholder="Senha" required="required">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="form-group col-xs-12">
          <button type="submit" name="btn_entrar" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
      </div>
      <?php
        if (isset($_POST['btn_entrar'])){ //VALIDAR USUARIO
          $login->validarUsuario($_POST['email'], $_POST['senha']);
        }
      ?>
    </form>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
        <a href="#" data-toggle="modal" data-target="#modal_recuperacao"><i class="fa fa-lock"></i> Esqueci minha senha</a>
      </div>
      <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6 text-right">
        <a href="../usuarios/cadastrar_novo_usuario.php"><i class="fa fa-pencil-square-o"></i> Cadastre-se</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_recuperacao" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Recuperação de senha</h4>
      </div>
      <form method="POST" action="#" role="form">
        <div class="modal-body">
          <p>Digite abaixo o seu e-mail cadastrado no sistema.</p>
            <div class="form-group">
              <label>Email*</label>
              <input type="text" name="email" class="form-control" id="ipt_email">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-left"><i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
