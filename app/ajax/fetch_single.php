<?php

include('../database/db.php');
include('function.php');

if (isset($_POST["id_usuario"])) {
    $output    = array();
    $statement = $connection->prepare("SELECT * FROM usuario 
    WHERE id_usuario = '" . $_POST["id_usuario"] . "' 
    LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $output["id_usuario"] = $row["id_usuario"];
        $output["usuario"]  = $row["usuario"];
        $output["senha"] = $row["senha"];
        $output["email"] = $row["email"];
        $output["telefone"] = $row["telefone"];
        
        /*if ($row["image"] != '') {
            $output['user_image'] = '<img src="upload/' . $row["image"] . '" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="' . $row["image"] . '" />';
        } else {
            $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
        }*/
    }
    echo json_encode($output);
}
?>