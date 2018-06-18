<?php
require_once 'lib/control/Sessao.php';
$sessao = new Sessao();
$sessao->redirecionar("index"); //VERIFICA SE O USUARIO ESTÁ LOGADO

?>