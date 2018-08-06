<?php
require_once 'novo_usuario.php';

$usuario = new Novo_usuario();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VCT Solutions - Cadastre-se</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url('../img/bg-login.jpg'); background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;" alt="Responsive image">
<div class="login-box">
  <div class="login-logo">
    <a href="../login/login.php" style="text-shadow: 2px 2px 2px #000000; color: #fff !important;"><b>VCT </b>Solutions</a>
  </div>
  <div class="login-box-body">
    <form action="#" method="post">
      <?php
        if (isset($_POST['btn_cadastrar'])){ //VALIDAR USUARIO
          $usuario->validarUsuario($_POST);
        } else {
          $usuario->novoUsuarioForm();
        }
      ?>
    </form>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
          <a href="../login/login.php"><i class="fa fa-home"></i> Já sou cadastrado</a>
        </div>
      </div>
  </div>
</div>

<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>

<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()
  })
</script>

</body>
</html>
