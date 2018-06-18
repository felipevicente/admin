<?php 

require_once '../../app/database/Conexao.php';
require_once '../../app/control/Sessao.php';
require_once '../../app/outros/Msg.php';

class Validar_login {
    //VALIDAR USUÁRIO EXISTENTE NO SISTEMA
	public function validarUsuario($email, $senha){

        $msg = new Msg();
        //VALIDA CAMPOS VAZIOS
        if(empty($email) || empty($senha)){ 
            $msg->MsgErro('Existe campos vazios');
        } else { //FAZ VALIDAÇÃO
            $con = new Conexao();
            // abre a conexão
            $PDO = $con->conectar();
            //faz select
            $sql = "SELECT email, senha FROM usuario
                    WHERE email = '$email'";
            // seleciona os registros
            $stmt = $PDO->prepare($sql);

            if ($stmt->execute()) {

                while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //VALIDA USUÁRIO COM MD5
                    if(($resultado['email'] === $email) && ($resultado['senha'] === md5($senha))){
                        $sessao = new Sessao();
                        $sessao->iniciar_sessao($email);
                    } else {
                        $msg->MsgErro('Usuário ou senha incorreto!');
                    }
                }
            } else {
                echo "Erro!";
                print_r($stmt->errorInfo());
            }
        }
	}
}