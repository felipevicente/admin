<?php 

require_once '../../app/database/Conexao.php';

class Usuario {

    public function listarUsuario(){
        $con = new Conexao();
        $pdo = $con->conectar();

        //SQL
        $sql = "SELECT id_usuario, ativo, sobre_nome, nome, email, telefone, data_cadastro
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
                echo '<tr>
                        <td>'.$row['id_usuario'].'</td>
                        <td>'.$row['nome'].' '.$row['sobre_nome'].'</td>
                        <td>'.$ativo.'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['telefone'].'</td>
                        <td>'.date('d/m/Y H:i:s', strtotime($row['data_cadastro'])).'</td>
                        <td>
                         <a href="cadastar_usuario.php?editar='.$row['id_usuario'].'" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                         </a>
                         <!--- <a href="#" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detalhar">
                          <span class="glyphicon glyphicon-search"></span>
                         </a>--->
                         <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir">
                          <span class="glyphicon glyphicon-remove"></span>
                         </a>
                        </td>
                      </tr>';
            }
        }
    }

    public function buscaSimplesUsuario($busca){

        if ($busca === "") {
            echo $this->listarUsuario();
        } else {
            $con = new Conexao();
            $pdo = $con->conectar();

            //SQL
            $sql = "SELECT id_usuario, nome, sobre_nome, ativo, email, telefone, data_cadastro
                    FROM usuario
                    WHERE id_usuario LIKE '%$busca%'
                    OR nome LIKE '%$busca%'
                    OR email LIKE '%$busca%'
                    OR telefone LIKE '%$busca%'
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
                    echo '<tr>
                           <td>'.$row['id_usuario'].'</td>
                           <td>'.$row['nome'].' '.$row['sobre_nome'].'</td>
                           <td>'.$ativo.'</td>
                           <td>'.$row['email'].'</td>
                           <td>'.$row['telefone'].'</td>
                           <td>'.date('d/m/Y H:i:s', strtotime($row['data_cadastro'])).'</td>
                           <td>
                             <a href="cadastar_usuario.php?editar='.$row['id_usuario'].'" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar">
                              <span class="glyphicon glyphicon-edit"></span>
                             </a>
                             <!--- <a href="#" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detalhar">
                              <span class="glyphicon glyphicon-search"></span>
                             </a>--->
                             <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir">
                              <span class="glyphicon glyphicon-remove"></span>
                             </a>
                            </td>
                          </tr>';
                }
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
            $sql = "SELECT id_usuario, nome, sobre_nome, ativo, email, telefone, data_cadastro
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
                    echo '<tr>
                           <td>'.$row['id_usuario'].'</td>
                           <td>'.$row['nome'].' '.$row['sobre_nome'].'</td>
                           <td>'.$ativo.'</td>
                           <td>'.$row['email'].'</td>
                           <td>'.$row['telefone'].'</td>
                           <td>'.date('d/m/Y H:i:s', strtotime($row['data_cadastro'])).'</td>
                           <td>
                            <a href="cadastar_usuario.php?editar='.$row['id_usuario'].'" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar">
                              <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <!--- <a href="#" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detalhar">
                             <span class="glyphicon glyphicon-search"></span>
                            </a>--->
                            <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir">
                             <span class="glyphicon glyphicon-remove"></span>
                            </a>
                           </td>
                          </tr>';
                }
            }
        }
    }

    public function novoUsuario(){
        
        $form = '<div class="col-md-6">
                  <div class="form-group">
                      <input type="hidden" name="id_usuario" class="form-control" id="ipt_id_usuario">
                      <label>Nome*</label>
                      <input type="text" name="nome" class="form-control" id="ipt_nome">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sobre Nome*</label>
                      <input type="text" name="sobre_nome" class="form-control" id="ipt_sobre_nome">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email*</label>
                      <input type="text" name="email" class="form-control" id="ipt_email">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Telefone</label>
                      <input type="text" name="telefone" class="form-control" id="ipt_telefone">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Senha*</label>
                      <input type="password" name="senha" class="form-control" id="ipt_senha">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Confirmar Senha*</label>
                      <input type="password" name="conf_senha" class="form-control" id="ipt_conf_senha">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Ativo</label>
                      <select name="ativo" class="form-control" id="opt_ativo">
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                      </select>
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

          $form = '<div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="id_usuario" value="'.$row['id_usuario'].'" class="form-control" id="ipt_id_usuario">
                        <label>Nome*</label>
                        <input type="text" name="nome" value="'.$row['nome'].'" class="form-control" id="ipt_nome">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Sobre Nome*</label>
                        <input type="text" name="sobre_nome" value="'.$row['sobre_nome'].'" class="form-control" id="ipt_sobre_nome">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email*</label>
                        <input type="text" name="email" value="'.$row['email'].'" class="form-control" id="ipt_email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" value="'.$row['telefone'].'" class="form-control" id="ipt_telefone">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Senha*</label>
                        <input type="password" name="senha" value="'.$row['senha'].'" class="form-control" id="ipt_senha">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Confirmar Senha*</label>
                        <input type="password" name="conf_senha" value="'.$row['senha'].'" class="form-control" id="ipt_conf_senha">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Ativo</label>
                        <select name="ativo" value="N" class="form-control" id="opt_ativo">
                          <option value="S" '.$s.'>Sim</option>
                          <option value="N" '.$n.';>Não</option>
                        </select>
                      </div>
                    </div>';
      return $form;
    }

    public function cadastrarUsuario($post){
      //var_dump($post);

        $con = new Conexao();
        $pdo = $con->conectar();
        $id_usuario = isset($post['id_usuario']) ? (int) $post['id_usuario'] : null;
        //$id_usuario = $_GET['id_usuario'];
        $nome = $post['nome'];
        $sobre_nome = $post['sobre_nome'];
        $email = $post['email'];
        $telefone = $post['telefone'];
        $senha = $post['senha'];
        $ativo = $post['ativo'];
        $data_cadastro = date('Y-m-d H:i');

        if(empty($post['id_usuario'])){ //NOVO USUARIO
            $sql = "INSERT INTO usuario(nome, sobre_nome, email, telefone, senha, ativo, data_cadastro) 
                    VALUES ('$nome', '$sobre_nome', '$email', '$telefone', '$senha', '$ativo', '$data_cadastro')";
            // seleciona os registros
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            header("Location: listar_usuario.php");
        } else {
            $sql = "UPDATE usuario SET nome = '$nome', sobre_nome = '$sobre_nome', email = '$email', telefone = '$telefone',
                    senha = '$senha', ativo = '$ativo'
                    WHERE id_usuario = '$id_usuario'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            header("Location: listar_usuario.php");
        }
    }
}
?>