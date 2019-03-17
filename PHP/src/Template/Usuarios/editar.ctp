<div class="profile col-md-5">
		<div class="col-md-12">

			<div class="profile-sidebar">
                <div class="col-md-12 text-center">
                <small>
                     Criado em:
                     <?php
                         echo date("d/m/Y", strtotime( $info_usuario['criado'] ) );
                     ?>
                     &bull; Modificado em:
                     <?php
                        if( is_null( $info_usuario['modificado'] ) ) {
                            echo date( "d/m/Y", strtotime( $info_usuario['criado'] ) );
                        }
                        else {
                            echo date( "d/m/Y", strtotime( $info_usuario['modificado'] ) );
                        }
                     ?>
                 </small>
             </div>
			 <?php  ?>
				<div class="profile-userpic">
                    <?php
                        if( is_null( $info_usuario['foto'] ) ) {
                            $imagem = 'default.jpg';
                        }
                        else {
                            $imagem = $info_usuario['foto'];
                        }

                        echo $this->Html->image( 'UsuariosAvatar/' . $imagem, [
                            'class' => 'img-responsive'
                        ]);
                    ?>
				</div>
                <form method="post" action="<?php echo $this->Url->Build([
                    'controller'    =>  'Usuarios',
                    'action'        =>  'editar'
                ]); ?>"  enctype="multipart/form-data">
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input name="foto" type="file" id="exampleInputFile" class="custom-file-input" />
                    <label class="custom-file-label">meu_avatar.jpg</label>
                  </div>
                </div>
				<div class="profile-usertitle">
                    <hr />
                        <div class="form-group">
                          <label>Nome</label>
                          <input name="nome" type="text" class="form-control" value="<?php echo $info_usuario['nome']; ?>" />
                        </div>
                      <div class="form-group">
                        <label>Email address</label>
                        <input name="email" type="email" class="form-control" value="<?php echo $info_usuario['email']; ?>" />
                    </div>
                      <div class="form-group">
                        <label>Senha</label>
                        <input name="senha" type="password" class="form-control" placeholder="Digite aqui sua senha...">
                        <small class="form-text text-muted">Deixe em branco para permanecer com a senha atual.</small>
                      </div>
                      <button type="submit" class="btn btn-success">Editar</button>
				</div>
                </form>
			</div>
		</div>
	</div>
