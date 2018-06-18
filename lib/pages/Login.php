<?php 

require_once '/../database/Conexao.php';

class Login {
    //VALIDAR USUÁRIO EXISTENTE NO SISTEMA
	public function validarUsuario($usuario, $senha){

		$con = new Conexao();
		// abre a conexão
		$PDO = $con->conectar();
		//faz select
		$sql = "SELECT usuario, senha FROM usuario
				WHERE usuario = '$usuario' 
				AND senha = '$senha'";
		// seleciona os registros
		$stmt = $PDO->prepare($sql);
		$stmt->execute();

		if ($stmt->execute()) {
			$erro = TRUE;
            while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
            	if ($resultado['usuario'] == $usuario && $resultado['senha'] == $senha) {
            		$erro = FALSE;
            	}
            }
            if($erro == TRUE){
                echo '<p class="col-red"><strong>Ops!</strong> Usuário ou senha incorreto!</p>
                      <script type="text/javascript">$("#usuario").val("'.$usuario.'");</script>';
            } else {
            	header('Location: ../pages/usuario_lista.php');
            }
        } else {
            echo "Erro! ";
            print_r($stmt->errorInfo());
        }
        return $resultado;
	}
}