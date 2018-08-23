<?php

require_once '/../database/Conexao.php';

class Sessao {

	public function iniciar_sessao($email){

		$con = new Conexao();
		// abre a conexão
		$PDO = $con->conectar();
		//SQL
		$sql = "SELECT id_usuario, nome, email, foto
				FROM usuario
        	    WHERE email = '$email'";

    	$stmt = $PDO->prepare($sql);
		$stmt->execute();

		$array_dados_usuario = array();
		
		if ($stmt->execute()) {
            while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
            	$array_dados_usuario['id_usuario'] = $resultado['id_usuario'];
            	$array_dados_usuario['nome'] = $resultado['nome'];
            	$array_dados_usuario['email'] = $resultado['email'];
            	$array_dados_usuario['foto'] = $resultado['foto'];
            }
            
            session_start();
			$_SESSION['sessao_ativo'] = TRUE;
			$_SESSION['sessao_dados_usuario'] = $array_dados_usuario;
			header('Location: ../usuarios/listar_usuario.php'); //DEPOIS INSERIR PARA REDIRECIONAR PARA DASHBOARD
        } else {
        	echo "Erro!";
		    die(print_r($stmt->errorInfo()));
        }
		
	}

	public function logado(){ //VERIFICA SE TIVER LOGADO NAS PÁGINAS PADRÕES
		session_start();
		ob_start(); //GAMBIARRA PARA CARREGAR O HEADER
		if (empty($_SESSION['sessao_ativo'])) {
			$this->logout();
		}
	}

	public function logout(){ //REMOVE TODAS SESSÕES E DESLOGA USUARIO
		session_start();
		session_destroy();
		ob_end_flush(); //GAMBIARRA PARA FINALIZAR O HEADER

		unset(
			$_SESSION['sessao_ativo'],
			$_SESSION['usuario_ativo']
			);
			header('Location: ../../pages/login/login.php');
	}

	public function redirecionar($pagina){ //REDIRECIONA DE ACORDO COM O SOLICITADO
		if ($pagina == "index") {
			header('Location: pages/usuarios/listar_usuario.php'); //VERIFICAR QUAL PÁGINA SERÁ A INICIAL	
		} else {
			echo "erro";
		}
	}

}

?>