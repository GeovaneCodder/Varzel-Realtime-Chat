<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ArrayEnterprises: <?php echo $this->fetch( 'title' ); ?></title>
    <?php
        #echo $this->Html->meta( 'icon' );
        echo $this->Html->css([
            'bootstrap.min',
            'style.css'
        ]);

        echo $this->fetch( 'meta' );
        echo $this->fetch( 'css' );
        echo $this->fetch( 'script' );
    ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo $this->Url->build('/'); ?>"><b>ArrayEnterprises</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo $this->Url->build('/'); ?>">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Minha conta
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php
                    if( ! $this->request->getSession()->read('Auth.User') ) {
                        echo '<a class="dropdown-item" href="' . $this->Url->build([
                                                                'controller' => 'Usuarios',
                                                                'action'     => 'login']) . '">Login</a>';

                        echo '<a class="dropdown-item" href="' . $this->Url->build([
                                                                'controller' => 'Usuarios',
                                                                'action'     => 'cadastro']) . '">Cadastrar-me</a>';
                    }
                    else {
                        echo '<a class="dropdown-item" href="' . $this->Url->build([
                                                                'controller' => 'Usuarios',
                                                                'action'     => 'editar']) . '">Editar conta</a>';

                        if( $this->request->getSession()->read('Auth.User.admin') ) {
                            echo '<a class="dropdown-item" href="' . $this->Url->build([
                                                                    'controller' => 'Comentarios',
                                                                    'action'     => 'listarMeusComentarios']) . '"><small>Administrar Comentários</small></a>';
                        }
                        else {
                            echo '<a class="dropdown-item" href="' . $this->Url->build([
                                                                    'controller' => 'Comentarios',
                                                                    'action'     => 'listarMeusComentarios']) . '">Meus Comentários</a>';
                        }
                        echo '<div class="dropdown-divider"></div>';
                        echo '<a class="dropdown-item" href="' . $this->Url->build([
                                                                'controller' => 'Usuarios',
                                                                'action'     => 'logout']) . '">Sair</a>';
                    }
                ?>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="<?php echo $this->Url->build([
                                                'controller' => 'Comentarios',
                                                'action'     => 'buscar']); ?>">
          <input class="form-control mr-sm-2" name="buscar" type="text" placeholder="Procurar autor" aria-label="Procurar autor">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Procurar</button>
        </form>
      </div>
    </nav>
    <div class="container">
        <?php
            echo $this->Flash->render();
            echo $this->fetch( 'content' );
        ?>
    </div>
    <?php
        echo $this->Html->script([
            'jquery-3.3.1.min',
            'bootstrap.bundle.min.js',
            'bootstrap.min',
            'default.js'
        ]);
    ?>
</body>
</html>
