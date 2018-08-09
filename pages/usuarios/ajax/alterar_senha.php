<?php
require_once '../../../app/database/Conexao.php';

$id_usuario = $_POST['id_usuario'];
$senha = md5($_POST["senha"]);

//VERIFICA SE O  POSSUI O ID DO USUARIO
if (isset($_POST["id_usuario"])) {
    //ABRE CONEXÃO
    $con = new Conexao();
    $pdo = $con->conectar();
    //SQL
     $sql = "UPDATE usuario SET senha = '$senha'
            WHERE id_usuario = '$id_usuario'";
    // SELECIONA OS REGISTROS
    $stmt = $pdo->prepare($sql);
    $resultado = $stmt->execute();
    //INFORMA SE FOI FEITO
    if ($stmt->execute()) {
        echo json_encode('true');
    } else {
        echo json_encode(print_r($stmt->errorInfo()));
        //print_r($stmt->errorInfo());
    }
}

?>