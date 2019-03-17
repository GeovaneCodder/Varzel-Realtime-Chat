<div id="comentarios-table-wrap">
<?php
    $usuario_logado = $this->request->getSession()->read('Auth.User');
    if( $usuario_logado ) :
?>
<div class="col-md-7" style="margin: 2% auto;">
    <button style="margin-left: -15px;" class="btn btn-primary" data-toggle="modal" data-target="#formComentario">Novo comentario</button>
</div>
<div class="modal fade" id="formComentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content form-modal-sucesso" style="display:none;">
        <div class="modal-header" style="border-bottom: none;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-success" role="alert">
                Comentário adicionado com sucesso! <br />
                A ArrayEnterprises agradece.
            </div>
        </div>
    </div>
    <div class="modal-content form-modal-com">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo comentário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formFilds" action="#">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo $usuario_logado['nome']; ?>" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comentário:</label>
            <?php
                $placeholder_text_area = "Digite aqui seu comentário, sua opnião é muito importante para nós da ArrayEnterprises.";
            ?>
            <textarea class="form-control" id="comentario_texto"
            placeholder="<?php echo $placeholder_text_area; ?>" rows="10" ></textarea>
            <small style="color: red; display:none;" class="min_comment">
                Seu comentário deve ter no mínimo 10 letras.
            </small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary" id="enviarComentario">Enviar comentário</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?php
    endif;
?>
    <div class="my-3 p-2 bg-white rounded shadow-sm col-md-7" style="margin: 0 auto;">
        <h6 class="border-bottom border-gray pb-2 mb-0">Comentários</h6>
        <?php
            $x = 1;
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

            echo $this->Html->image( 'UsuariosAvatar/' . $usuario_avatar, [
            'style' => 'width:32px; height:32px',
            'class' => 'bd-placeholder-img mr-2 rounded']);
        ?>
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark"><?php echo $coment['Usuarios']['nome']; ?>
                <small>
                    <?php
                        echo "<b>Postado em:</b> " . date("d/m/Y - H:i:s", strtotime( $coment['criacao'] ) );

                        if( $coment['modificado'] ) {
                            echo " <b>Editado em:</b>" . date("d/m/Y - H:i:s", strtotime( $coment['modificado'] ) );
                        }
                    ?>
                </small>
            </strong>
            <a data-toggle="modal" href="#_comentarioExibirLargo<?php echo $x; ?>">
                          <?php echo mb_strimwidth( $coment['comentario'] , 0, 100, "..." ); ?>
            </a>
          </p>
        </div>

        <div class="modal fade showcoment_" id="_comentarioExibirLargo<?php echo $x; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            $x++;
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
