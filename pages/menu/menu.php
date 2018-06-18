<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php echo '<img src="../../uploads/img/'.$_SESSION['sessao_dados_usuario']['foto'].'"class="img-circle" alt="User Image">'?> 
        </div>
        <div class="pull-left info">
          <p>
            <?php
              echo $_SESSION['sessao_dados_usuario']['nome'] .' '. $_SESSION['sessao_dados_usuario']['sobre_nome'];
            ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Procurar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list-alt"></i> <span> Cadastros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-user"></i> Clientes</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-stats"></i> Fornecedores</a></li>
            <li><a href="#"><i class="fa fa-black-tie"></i> Funcionários</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-barcode"></i> <span> Produtos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-cube"></i> Gerenciar Produtos</a></li>
          </ul>
        </li><li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span> Serviços</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-random"></i> Gerenciar Serviços</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span> Configurações</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/usuarios/listar_usuario.php"><i class="fa fa-user"></i> Usuários</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>