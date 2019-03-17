<div class="my-3 p-2 bg-white rounded shadow-sm col-md-7 col-sm-12" style="margin: 0 auto;">
    <h6 class="border-bottom border-gray pb-2 mb-0">Comentários</h6>
    <?php
        $i = 1;
        foreach( $comentarios as $coment ) :
    ?>
    <div class="media text-muted pt-3">

    <?php
        if( $coment['Usuarios']['foto'] == null ||
            empty( $coment['Usuarios']['foto'] ) ||
            $coment['Usuarios']['foto'] == "" )
        {
            $usuario_avatar = "default.jpg";
        }
        else {
            $usuario_avatar = $coment['Usuarios']['foto'];
        }
        echo $this->Html->image( 'UsuariosAvatar/' .$usuario_avatar, [
        'style' => 'width:32px; height:32px',
        'class' => 'bd-placeholder-img mr-2 rounded']);
    ?>


      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark"><?php echo $coment['Usuarios']['nome']; ?>
            <small>
                <?php
                    echo "<b>Postado em:</b> " . date("d/m/Y - H:i:s", strtotime( $coment['criacao'] ) );

                    if( $coment['modificado'] ) {
                        echo "<br /><b>Editado em:</b>" . date("d/m/Y - H:i:s", strtotime( $coment['modificado'] ) );
                    }
                ?>
            </small>
        </strong>

        <a data-toggle="modal" href="#_comentarioExibirLargo<?php echo $i; ?>">
                      <?php echo mb_strimwidth( $coment['comentario'] , 0, 40, "..." ); ?>
        </a>
      </p>
      <div class="dropdown" style="display: inline; float: right;">
          <button class="btn btn-primary btn-md dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opções
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarComentario<?php echo $i; ?>">Editar</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#apagarComentario<?php echo $i; ?>"><strong style="color: red;">Apagar</strong></a>
          </div>
      </div>
    </div>
    <div class="modal fade" id="apagarComentario<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Você tem certeza?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Seu comentário está prestes a ser apagado, tem certeza que deseja continuar com está ação.
            <br />
            <small>Após está ação ser executada não será mais possível reverte-lá.</small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onclick="apagar_comentario(<?php echo $coment['id']; ?>)">Apagar Comentário</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulario Editar Comentário -->
<div class="modal fade" id="editarComentario<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Comentário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo $this->request->getSession()->read('Auth.User.nome'); ?>" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comentário:</label>
            <textarea class="form-control" id="comentario_texto" rows="10"><?php echo $coment['comentario']; ?></textarea>
            <small style="color: red; display:none;" class="min_comment">
                Seu comentário deve ter no mínimo 10 letras.
            </small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-success" onclick="editar_comentario(<?php echo $coment['id']; ?>)">Salva</button>
          </div>
        </form>
      </div>
    </div>
    </div>
</div>
    <!-- /Formulario editar comentário -->

<!-- COMENTARIO EXIBIR -->
<div class="modal fade showcoment_" id="_comentarioExibirLargo<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $coment['Usuarios']['nome']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <?php echo $coment['comentario']; ?>
      </div>
    </div>
  </div>
</div>

    <?php
            $i = $i + 1;
        endforeach;
    ?>
</div>
<?php
    $this->Paginator->setTemplates([
        "number"            =>  "<li class='page-item'><a class='page-link' href='{{url}}'>{{text}}</a></li>",
        "current"           =>  "<li class='page-item active'><a class='page-link' href='{{url}}'>{{text}}</a></li>",
        "first"             =>  "<li class='page-item'><a class='page-link' href='{{url}}'>&laquo;</a></li>",
        "last"              =>  "<li class='page-item'><a class='page-link' href='{{url}}'>&raquo;</a></li>",
        "prevActive"        =>  "<li class='page-item'><a class='page-link' href='{{url}}'>&lt;</a></li>",
        "nextActive"        =>  "<li class='page-item'><a class='page-link' href='{{url}}'>&gt;</a></li>"
    ]);
?>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
    <?php

        echo $this->Paginator->first();

        if( $this->Paginator->hasPrev() ) {
            echo $this->Paginator->prev();
        }

        echo $this->Paginator->numbers();

        if( $this->Paginator->hasNext() ) {
            echo $this->Paginator->next();
        }

        echo $this->Paginator->last();
    ?>
    </ul>
</nav>
