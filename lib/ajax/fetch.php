<?php

include('../database/db.php');
include('function.php');

$query  = '';
$output = array();
$query .= 'SELECT * FROM usuario ';

if (isset($_POST["search"]["value"])) { //INCLUI O LIKE NA PESQUISA
    $query .= 'WHERE id_usuario LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR usuario LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR email LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) { //ORDENAÇÃO
    $coluna = intval($_POST['order'][0]['column'] +1); //ACRESCENTA COLUNA +1, POIS A MESMA INICIA EM 0
    switch ($coluna) { //VERIFICA A ORDEM DAS COLUNAS NO BANCO
        case 1:
            $coluna = 'id_usuario';
            break;
        case 2:
            $coluna = 'usuario';
            break;
        case 3:
            $coluna = 'email';
            break;
    }
    $query .= 'ORDER BY ' . $coluna . ' ' . $_POST['order']['0']['dir'] . ' ';
} else { //ORGANIZA DECRESCENTE
    $query .= 'ORDER BY id_usuario DESC ';
}

if ($_POST["length"] != -1) { //REALIZA PÁGINAÇÃO
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'] .' ';
}

$statement = $connection->prepare($query); //INSERE O CÓDIGO DO SELECT
$statement->execute(); //EXECUTA SELECT
$resultado        = $statement->fetchAll(); //TRÁS RESULTADO DO SELECT
$dados          = array(); //ARRAY QUE RECEBE DADOS
$filtered_rows = $statement->rowCount(); //QUANTIDADE DE RESULTADOS (COUNT)

foreach ($resultado as $row) { //
    /*$image = '';

    if ($row["foto"] != '') {
        $image = '<img src="upload/' . $row["foto"] . '" class="img-thumbnail" width="50" height="35" />';
    } else {
        $image = '';
    }*/

    $sub_array   = array();
    //$sub_array[] = $image;
    $sub_array[] = $row["id_usuario"];
    $sub_array[] = $row["usuario"];
    $sub_array[] = $row["email"];
    /*$sub_array[] = '<button type="button" name="update" id="' . $row["id_usuario"] . '" class="btn btn-warning btn-xs update"><i class="material-icons">mode_edit</i></button>';
    $sub_array[] = '<button type="button" name="delete" id="' . $row["id_usuario"] . '" class="btn btn-danger btn-xs delete"><i class="material-icons">delete</i></button>';*/
    $sub_array[] = '<a class="btn btn-warning btn-xs update" href="usuario_cadastro.php?id='. $row["id_usuario"] .'"><i class="material-icons">mode_edit</i></a>';
    $sub_array[] = '<button type="button" name="delete" id="' . $row["id_usuario"] . '" class="btn btn-danger btn-xs delete"><i class="material-icons">delete</i></button>';
    $dados[]      = $sub_array;
}

$output = array(
    //"draw" => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => get_total_all_records(),
    "data" => $dados
);

echo json_encode($output);
?>