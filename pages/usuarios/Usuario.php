<?php 

require_once '../../app/database/Conexao.php';
require_once '../../app/outros/msg.php';

class Usuario {

    public function listarUsuario(){
        $con = new Conexao();
        $pdo = $con->conectar();

        //SQL
        $sql = "SELECT id_usuario, ativo, nome, email, celular, data_cadastro
                FROM usuario
                ORDER BY id_usuario DESC";
        // SELECIONA OS REGISTROS
        $stmt = $pdo->prepare($sql);

        if($stmt->execute()){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $ativo = $row['ativo'];
                if($ativo === "S"){
                    $ativo = '<i class="glyphicon glyphicon-ok text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ativo">&nbsp;</i>';
                } else {
                    $ativo = '<i class="glyphicon glyphicon glyphicon-remove text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inativo">&nbsp;</i>';
                }
                echo '<tr id="'.$row['id_usuario'].'">
                        <td>'.$row['id_usuario'].'</td>
                        <td>'.$row['nome'].'</td>
                        <td>'.$ativo.'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['celular'].'</td>
                        <td>'.date('d/m/Y H:i:s', strtotime($row['data_cadastro'])).'</td>
                        <td>
                          <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="cadastar_usuario.php?editar='.$row['id_usuario'].'"><span class="glyphicon glyphicon-edit text-warning"></span> Editar</a></li>
                            <li class="divider"></li>
                            <li><a name="delete" id="'.$row['id_usuario'].'" class="delete"><span class="glyphicon glyphicon-remove text-danger"></span> Excluir</a></li>
                            <li class="divider"></li>
                            <li><a name="alt_senha" id="'.$row['id_usuario'].'" class="alt_senha" data-toggle="modal" data-target="#modal_alterar_senha"><i class="fa fa-unlock-alt text-success" aria-hidden="true"></i> Alterar Senha</a></li>
                          </ul>
                        </div>
                        </td>
                      </tr>';
            }
        }
    }

    public function buscaAvancadaUsuario($busca){

        if ($busca['busca'] === "") {
            echo $this->listarUsuario();
        } else {

            $tipo_busca = isset($busca['tipo_busca']) ? $busca['tipo_busca'] : "";
            $valor_busca = isset($busca['busca']) ? $busca['busca'] : "";

            $con = new Conexao();
            $pdo = $con->conectar();

            //SQL
            $sql = "SELECT id_usuario, nome, ativo, email, celular, data_cadastro
                    FROM usuario
                    WHERE $tipo_busca LIKE '%$valor_busca%'
                    ORDER BY id_usuario DESC";
            //SELECIONA OS REGISTROS
            $stmt = $pdo->prepare($sql);

            if($stmt->execute()){
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $ativo = $row['ativo'];
                    if($ativo === "S"){
                        $ativo = '<i class="glyphicon glyphicon-ok text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ativo">&nbsp;</i>';
                    } else {
                        $ativo = '<i class="glyphicon glyphicon glyphicon-remove text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inativo">&nbsp;</i>';
                    }
                    echo '<tr id="'.$row['id_usuario'].'">
                           <td>'.$row['id_usuario'].'</td>
                           <td>'.$row['nome'].'</td>
                           <td>'.$ativo.'</td>
                           <td>'.$row['email'].'</td>
                           <td>'.$row['celular'].'</td>
                           <td>'.date('d/m/Y H:i:s', strtotime($row['data_cadastro'])).'</td>
                           <td>
                            <a href="cadastar_usuario.php?editar='.$row['id_usuario'].'" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar">
                              <span class="glyphicon glyphicon-edit"></span>
                            </a>
                             <button name="delete" id="'.$row['id_usuario'].'" class="btn btn-xs btn-danger delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir">
                              <span class="glyphicon glyphicon-remove"></span>
                             </button>
                             <button name="alt_senha" id="'.$row['id_usuario'].'" class="btn btn-xs bg-purple alt_senha" data-toggle="modal" data-target="#modal_alterar_senha" data-original-title="Alterar Senha">
                              <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                             </button>
                           </td>
                          </tr>';
                }
            }
        }
    }

    public function novoUsuario(){
        
        $form = '<div class="col-md-5">
                  <div class="form-group">
                      <input type="hidden" name="id_usuario" class="form-control" id="ipt_id_usuario" maxlength="11">
                      <label>Nome*</label>
                      <input type="text" name="nome" class="form-control" id="ipt_nome" maxlength="200" required="required" autofocus>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Email*</label>
                      <input type="text" name="email" class="form-control" id="ipt_email" maxlength="150" required="required">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Celular</label>
                      <input type="text" name="celular" class="form-control" id="ipt_celular" maxlength="15">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Senha*</label>
                      <input type="password" name="senha" class="form-control" id="ipt_senha" maxlength="32" required="required">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Confirmar Senha*</label>
                      <input type="password" name="conf_senha" class="form-control" id="ipt_conf_senha" maxlength="32" required="required">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Ativo</label>
                      <select name="ativo" class="form-control" id="opt_ativo">
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                      </select>
                    </div>
                  </div>';

        echo $form;
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
          $s = '';
          $n = '';
          switch ($row['ativo']) {
            case 'S':
              $s = 'selected="selected"';
              break;
            case 'N':
              $n = 'selected="selected"';
              break;
          }

          $form = '<div class="col-md-5">
                    <div class="form-group">
                        <input type="hidden" name="id_usuario" value="'.$row['id_usuario'].'" class="form-control" id="ipt_id_usuario" maxlength="11">
                        <label>Nome*</label>
                        <input type="text" name="nome" value="'.$row['nome'].'" class="form-control" id="ipt_nome" maxlength="200" required="required">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Email*</label>
                        <input type="text" name="email" value="'.$row['email'].'" class="form-control" id="ipt_email" maxlength="150" required="required">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Celular</label>
                        <input type="text" name="celular" value="'.$row['celular'].'" class="form-control" id="ipt_celular" maxlength="15">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Ativo</label>
                        <select name="ativo" class="form-control" id="opt_ativo">
                          <option value="S" '.$s.'>Sim</option>
                          <option value="N" '.$n.'>Não</option>
                        </select>
                      </div>
                    </div>';
      echo $form;
    }

    public function erroValidarUsuario($post){

      $s = '';
      $n = '';
      switch ($post['ativo']) {
        case 'S':
          $s = 'selected="selected"';
          break;
        case 'N':
          $n = 'selected="selected"';
          break;
      }

      $form = '<div class="col-md-5">
                  <div class="form-group">
                      <input type="hidden" name="id_usuario" class="form-control" id="ipt_id_usuario" maxlength="11">
                      <label>Nome*</label>
                      <input type="text" name="nome" value="'.$post["nome"].'" class="form-control" id="ipt_nome" maxlength="200" required="required">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Email*</label>
                      <input type="text" name="email" value="'.$post["email"].'" class="form-control" id="ipt_email" maxlength="150" required="required">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Celular</label>
                      <input type="text" name="celular" value="'.$post["celular"].'" class="form-control" id="ipt_celular" maxlength="15">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Senha*</label>
                      <input type="password" name="senha" class="form-control" id="ipt_senha" maxlength="32" required="required">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Confirmar Senha*</label>
                      <input type="password" name="conf_senha" class="form-control" id="ipt_conf_senha" maxlength="32" required="required">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Ativo</label>
                      <select name="ativo" class="form-control" id="opt_ativo">
                        <option value="S" '.$s.'>Sim</option>
                        <option value="N" '.$n.'>Não</option>
                      </select>
                    </div>
                  </div>';
      echo $form;
    }

    function validarUsuario($post){
      $this->erroValidarUsuario($post);
    }

    public function cadastrarUsuario($post){

        $con = new Conexao();
        $pdo = $con->conectar();
        $id_usuario = isset($post['id_usuario']) ? (int) $post['id_usuario'] : null;
        $nome = $post['nome'];
        $email = $post['email'];
        $celular = $post['celular'];
        $senha = isset($post['senha']) ? md5($post['senha']) : "";
        $ativo = $post['ativo'];
        $data_cadastro = date('Y-m-d H:i:s');

        if(empty($post['id_usuario'])){ //NOVO USUARIO
            /*$msg = new msg();
            $msg->msgErro("Dados Incorretos.");*/
            $this->validarUsuario($post);
            //$this->dadosFormulario($post);
            /*$sql = "INSERT INTO usuario(nome, email, celular, senha, ativo, data_cadastro) 
                      VALUES ('$nome', '$email', '$celular', '$senha', '$ativo', '$data_cadastro')";
            $stmt = $pdo->prepare($sql);*/
        } else {
            $sql = "UPDATE usuario SET nome = '$nome', email = '$email', celular = '$celular', ativo = '$ativo'
                    WHERE id_usuario = '$id_usuario'";
            $stmt = $pdo->prepare($sql);
        }
        /*if ($stmt->execute()) {
          header("Location: listar_usuario.php");
        } else {
          die(print_r($stmt->errorInfo()));
        }*/
    }
}
?>