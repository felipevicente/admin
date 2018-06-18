<?php
include('../database/db.php');
include('function.php');

if (isset($_POST["operacao"])) {

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_cadastro = date('Y-m-d H:i:s'); //CONVERTAR HORARIO BRASIL

    if ($_POST["operacao"] == "adicionar") {
        
        /*$usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $data_cadastro = date('Y-m-d H:i:s'); //CONVERTAR HORARIO BRASIL*/

        /*$image = '';

        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
        }*/

        //NOVO CADASTRO
        $sql = "INSERT INTO usuario(usuario, senha, email, telefone, data_cadastro) 
                VALUES ('$usuario', '$senha', '$email', '$telefone', '$data_cadastro')";
        $statement = $connection->prepare($sql);

        if ($statement->execute()) {
            echo "Registro Salvo!";
        } else {
            echo "Erro ao cadastrar";
            print_r($statement->errorInfo());
        }

        
    }

    if ($_POST["operacao"] == "editar") {
        $id_usuario = $_POST["id_usuario"];
       /* $image = '';
        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
        } else {
            $image = $_POST["hidden_user_image"];
        }*/
        $query = "UPDATE usuario SET usuario = '$usuario', senha = '$senha', email = '$email', 
                  telefone = '$telefone', data_cadastro = '$data_cadastro'
                  WHERE id_usuario = $id_usuario";
        $statement = $connection->prepare($query);
        $result    = $statement->execute();
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}

?>