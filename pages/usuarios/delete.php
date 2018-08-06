<?php

require_once '../../app/database/Conexao.php';

if (isset($_POST["id_usuario"])) {


    $con = new Conexao();
    $pdo = $con->conectar();

    //SQL
    $sql = "DELETE FROM usuario WHERE id_usuario = ".$_POST["id_usuario"]."";
    // SELECIONA OS REGISTROS
    $stmt = $pdo->prepare($sql);
    $resultado = $stmt->execute();
    
    if (!empty($resultado)) {
        echo 'true';
    } else {
        echo 'false';
    }
}

?>