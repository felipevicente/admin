<?php
require_once 'app/control/Sessao.php';
$sessao = new Sessao();
$sessao->redirecionar("index"); //VERIFICA SE O USUARIO ESTÁ LOGADO

?>