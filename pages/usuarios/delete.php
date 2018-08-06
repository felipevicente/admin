<?php
require_once '../../app/database/Conexao.php';
//VERIFICA SE O  POSSUI O ID DO USUARIO
if (isset($_POST["id_usuario"])) {
    //ABRE CONEXÃO
    $con = new Conexao();
    $pdo = $con->conectar();
    //SQL
    $sql = "DELETE FROM usuario WHERE id_usuario = ".$_POST["id_usuario"]."";
    // SELECIONA OS REGISTROS
    $stmt = $pdo->prepare($sql);
    $resultado = $stmt->execute();
    //INFORMA SE FOI FEITO
    if (!empty($resultado)) {
        echo 'true';
    } else {
        echo 'false';
    }
}

?>