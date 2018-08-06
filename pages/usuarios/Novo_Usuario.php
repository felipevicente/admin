<?php

require_once '../../app/database/Conexao.php';
require_once '../../app/control/Sessao.php';
require_once '../../app/outros/Msg.php';

class Novo_usuario {

	function novoUsuarioForm(){
		  	echo '<div class="form-group">
			        <label>Nome</label>
			        <input type="text" name="nome" class="form-control" id="ipt_nome" required="required" autofocus>
			      </div>
			      <div class="form-group">
			        <label>Sobre Nome</label>
			        <input type="text" name="sobre_nome" class="form-control" id="ipt_sobre_nome" required="required">
			      </div>
			      <div class="form-group">
			        <label>Celular</label>
			        <input type="text" name="telefone" class="form-control" id="ipt_telefone" data-inputmask=\'"mask": "(99) 99999-9999"\' data-mask required="required">
			      </div>
			      <div class="form-group">
			        <label>Email</label>
			        <input type="text" name="email" class="form-control" id="ipt_email" required="required">
			      </div>
			      <div class="form-group">
			        <label>Senha</label>
			        <input type="password" name="senha" class="form-control" id="ipt_senha" required="required">
			      </div>
			      <div class="form-group">
			        <label>Confirmar Senha</label>
			        <input type="password" name="conf_senha" class="form-control" id="ipt_conf_senha" required="required">
			      </div>
			      <div class="row">
			        <div class="form-group col-xs-12">
			          <button type="submit" name="btn_cadastrar" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
			        </div>
			      </div>';

	}

	function ValidarUsuario($post){
		$msg = new Msg();
		switch ($post) {

			case $post['senha'] !== $post['conf_senha']:
				$this->ErroValidarUsuario($post);
		        $msg->MsgErro('Senhas não corespondem.');
				break;

			case isset($post['email']):
				$email = $post['email'];
				$con = new Conexao();
				// abre a conexão
				$PDO = $con->conectar();
				//faz select
				$sql = "SELECT count(email) as email
						FROM usuario
						WHERE email = '$email'";
				// seleciona os registros
				$stmt = $PDO->prepare($sql);

				if ($stmt->execute()) {
		            while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
		            	//VALIDA SE O USUÁRIO EXISTE
		            	if ($resultado['email'] >= 1) {
		            		$this->ErroValidarUsuario($post);
		            		$msg->MsgErro('Email já cadastrado.');
		            	} else {
		            		$this->CadastrarUsuario($post);
		            	}

		            }
		        } else {
		            echo "Erro!";
		            print_r($stmt->errorInfo());
		        }
				break;
		}

	}

	function ErroValidarUsuario($post){

		echo '<div class="form-group">
			        <label>Nome</label>
			        <input type="text" name="nome" value="'.$post['nome'].'" class="form-control" id="ipt_nome" required="required" autofocus>
			      </div>
			      <div class="form-group">
			        <label>Sobre Nome</label>
			        <input type="text" name="sobre_nome" value="'.$post['sobre_nome'].'" class="form-control" id="ipt_sobre_nome" required="required">
			      </div>
			      <div class="form-group">
			        <label>Telefone</label>
			        <input type="text" name="telefone" value="'.$post['telefone'].'" class="form-control" id="ipt_telefone" data-inputmask=\'"mask": "(99) 99999-9999"\' data-mask required="required">
			      </div>
			      <div class="form-group">
			        <label>Email</label>
			        <input type="text" name="email" value="'.$post['email'].'" class="form-control" id="ipt_email" required="required">
			      </div>
			      <div class="form-group">
			        <label>Senha</label>
			        <input type="password" name="senha" class="form-control" id="ipt_senha" required="required">
			      </div>
			      <div class="form-group">
			        <label>Confirmar Senha</label>
			        <input type="password" name="conf_senha" class="form-control" id="ipt_conf_senha" required="required">
			      </div>
			      <div class="row">
			        <div class="form-group col-xs-12">
			          <button type="submit" name="btn_cadastrar" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
			        </div>
			      </div>';

	}

	function CadastrarUsuario($post){
		//die(var_dump($post));

		$con = new Conexao();
		// abre a conexão
		$PDO = $con->conectar();

		$nome = $post['nome'];
        $sobre_nome = $post['sobre_nome'];
        $email = $post['email'];
        $telefone = $post['telefone'];
        $senha = md5($post['senha']);
        $usuario_principal = 'S';
        $data_cadastro = date('Y-m-d H:i');

		
		//faz select
		$sql = "INSERT INTO usuario(nome, sobre_nome, email, telefone, senha, usuario_principal, data_cadastro) 
                    VALUES ('$nome', '$sobre_nome', '$email', '$telefone', '$senha', '$usuario_principal', '$data_cadastro')";
        // seleciona os registros
        $stmt = $PDO->prepare($sql);
        // AO EXECUTAR
        if ($stmt->execute()) {
        	$sessao = new Sessao();
	        $sessao->iniciar_sessao($email);
        } else {
        	echo "Erro!";
            print_r($stmt->errorInfo());
        }
	}
	
}
?>