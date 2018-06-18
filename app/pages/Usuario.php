<?php 

require_once '/../database/Conexao.php';

class Usuario {

	public function cadastrarUsuario($post){

        $con = new Conexao();
        $pdo = $con->conectar();
        $usuario = $post['usuario'];
        $senha = $post['senha'];
        $email = $post['email'];
        $telefone = $post['telefone'];
        $data_cadastro = date('Y-m-d H:i');

        if(empty($post['id_usuario'])){ //NOVO USUARIO
            $sql = "INSERT INTO usuario(usuario, senha, email, telefone, data_cadastro) 
                    VALUES ('$usuario', '$senha', '$email', '$telefone', '$data_cadastro')";
            // seleciona os registros
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
	}

    public function novoUsuario(){
        
        $form = '<div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" name="usuario" id="txt_usuario" class="form-control">
                        <label class="form-label">Usuário</label>
                        <input type="hidden" name="id_usuario" id="txt_id_usuario">
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="password" name="senha" id="txt_senha" class="form-control">
                        <label class="form-label">Senha</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="password" name="conf_senha" id="txt_conf_senha" class="form-control">
                        <label class="form-label">Confirmar Senha</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" name="email" id="txt_email" class="form-control" />
                        <label class="form-label">Email</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" name="telefone" id="txt_telefone" class="form-control">
                        <label class="form-label">Telefone</label>
                    </div>
                </div>';

        return $form;
    }

    public function editarUsuario($id = null){

        $con = new Conexao(); //INSTANCIA A CONEXÃO
        $pdo = $con->conectar(); //ABRE CONEXÃO

        $sql = "SELECT * FROM usuario
                WHERE id_usuario = $id";
        
        $stmt = $pdo->prepare($sql); //INSERE SQL PARA EXECUÇÃO
        $stmt->execute(); //EXECULTA SQL
        $resultado = $stmt->fetchAll(); //TRÁS RESULTADO DO SELECT

        foreach ($resultado as $row)

        $form = '<div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" name="usuario" value="'.$row['usuario'].'" id="txt_usuario" class="form-control">
                        <label class="form-label">Usuário</label>
                        <input type="hidden" name="id_usuario" id="txt_id_usuario">
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="password" name="senha" id="txt_senha" class="form-control">
                        <label class="form-label">Senha</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="password" name="conf_senha" id="txt_conf_senha" class="form-control">
                        <label class="form-label">Confirmar Senha</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" name="email" value="'.$row['email'].'" id="txt_email" class="form-control" />
                        <label class="form-label">Email</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" name="telefone" value="'.$row['telefone'].'" id="txt_telefone" class="form-control">
                        <label class="form-label">Telefone</label>
                    </div>
                </div>';

        return $form;
    }
}