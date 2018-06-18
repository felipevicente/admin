<?php

include('../database/db.php');
include('function.php');

if (isset($_POST["id_usuario"])) {
    /*$image = get_image_name($_POST["user_id"]);
	    if ($image != '') {
	        unlink("upload/" . $image);
	    }*/
    $query = 'DELETE FROM usuario WHERE id_usuario = '.$_POST["id_usuario"].'';
    $statement = $connection->prepare($query);
    $result    = $statement->execute();
    if (!empty($result)) {
        echo 'true';
    } else {
        echo 'false';
    }
}

?>