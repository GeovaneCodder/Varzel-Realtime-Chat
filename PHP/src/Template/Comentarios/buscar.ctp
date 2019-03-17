<div class="my-3 p-2 bg-white rounded shadow-sm col-md-7 col-sm-12" style="margin: 0 auto;">
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
        endforeach;
    ?>
</div>
