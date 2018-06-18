<?php 

require_once '../../app/database/Conexao.php';
require_once '../../app/control/Sessao.php';

class Validar_login {
    //VALIDAR USUÁRIO EXISTENTE NO SISTEMA
	public function validarUsuario($email, $senha){

		$con = new Conexao();
		// abre a conexão
		$PDO = $con->conectar();
		//faz select
		$sql = "SELECT email, senha FROM usuario
				WHERE email = '$email' 
				AND senha = '$senha'";
		// seleciona os registros
		$stmt = $PDO->prepare($sql);

		if ($stmt->execute()) {
			//$erro = TRUE;
            while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
                die($resultado['senha']);
            	if ($resultado['email'] === $email && $resultado['senha'] === $senha) {
                    $sessao = new Sessao();
                    $sessao->iniciar_sessao($email);
            	} else {
                //if (empty($resultado['email']) && empty($resultado['senha'])) {
                    echo '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Ops!</h4>
                            Email ou senha incorretos.
                        </div>';
                }
            }
            /*if($erro === TRUE){
                echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Ops!</h4>
                        Email ou senha incorretos.
                      </div>';
            } else {
                $sessao = new Sessao();
                $sessao->iniciar_sessao($email);
            }*/
        } else {
            echo "Erro!";
            print_r($stmt->errorInfo());
        }
        return $resultado;
	}
}