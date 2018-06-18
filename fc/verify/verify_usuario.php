<?php 

require_once '/../../db/db.php';

$id_usuario = $_POST['id_usuario'];
$usuario = $_POST["usuario"];
$senha = $_POST['senha'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$data_cadastro = date("Y-m-d H:i:s");

$acao = isset($_GET['funcao']) ? $_GET['funcao'] : null;
echo $acao;

switch ($acao) {
	//EDITAR
	case 'editar':
		/*$PDO = db_connect();
		$sql = "UPDATE categoria SET id_categoria = '$id_categoria', descricao = '$descricao' 
				WHERE id_categoria = '$id_categoria'";
		$stmt = $PDO->prepare($sql);
		 
		if ($stmt->execute()) {
		    header('Location: ../categoria_lista.php');
		} else {
		    echo "Erro ao alterar";
		    print_r($stmt->errorInfo());
		}
		break;*/
	//DELETAR
	case 'deletar':
	

		$PDO = db_connect();
		$id = $_POST['id'];
		$sql = "DELETE FROM usuario WHERE id_usuario = '$id'";
		$stmt = $PDO->prepare($sql);
		echo json_encode([$id]);
		 
		if ($stmt->execute())
		{
		    echo "Sucesso";
		}
		else
		{
		    echo "Erro ao deletar";
		    print_r($stmt->errorInfo());
		}
		break;
	/*//BUSCAR
	case 'buscar':
		//var_dump($_POST);
		$opcao = $_POST["opcao"];
		$busca = $_POST["busca"];

		header('Location: ../categoria_lista.php?opcao='.$opcao.'&busca='.$busca.'');
		break;*/
	default:
			//NOVO CADASTRO
			$PDO = db_connect();
			$sql = "INSERT INTO usuario(usuario, senha, email, telefone, data_cadastro) VALUES ('$usuario', '$senha', '$email', '$telefone', '$data_cadastro');";
			$stmt = $PDO->prepare($sql);

			if ($stmt->execute()) {
				header('Location: ../../lista_usuario.php');
				exit;
			} else {
			    echo "Erro ao cadastrar";
			    print_r($stmt->errorInfo());
			}
		break;
}

