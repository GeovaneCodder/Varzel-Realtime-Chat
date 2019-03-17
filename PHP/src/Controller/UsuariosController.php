<?php

namespace App\Controller;
use Cake\Auth\DefaultPasswordHasher;
class UsuariosController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout', 'cadastro']);
    }

    public function index ()
    {

    }

    public function login ()
    {
        if( $this->Auth->user('id') ) {
            return $this->redirect( '/' );
        }

        if( $this->request->is( 'post' ) ) {

            $lgg = $this->Auth->identify();
            if ( $lgg ) {
                $this->Auth->setUser( $lgg );
                return $this->redirect( $this->Auth->redirectUrl() );
            }

            $this->Flash->error( 'Login ou senha incorretos.' );
        }
    }

    public function cadastro ()
    {
        $hasher = new DefaultPasswordHasher();

        $usuario_novo = $this->Usuarios->newEntity( $this->request->getData() );

        if( $this->request->is( 'post' ) ) {

            $usuario_novo = $this->Usuarios->patchEntity( $usuario_novo, $this->request->getData() );
            $usuario_novo['senha']  = $hasher->hash( $usuario_novo['senha'] );
            $usuario_novo['criado'] = date('Y-m-d H:i:s');

            if( $this->Usuarios->save( $usuario_novo ) ) {

                $this->Flash->success( __( 'Cadastro executado com sucesso!' ) );
                $this->Auth->setUser( $usuario_novo->toArray() );
                return $this->redirect( '/' );
            }

            $this->Flash->error(__('Erro ao se cadastrar.'));
        }
    }

    public function editar ()
    {
        $usuario_id = $this->request->getSession()->read('Auth.User.id');

        if( $this->request->is( 'get' ) ) {
            $info_usuario = $this->Usuarios->find( 'all' )
                                        ->where(['id' => $usuario_id]);
            $retorno = [];

            foreach( $info_usuario as $info ) {
                $retorno['nome']    = $info['nome'];
                $retorno['email']   = $info['email'];
                $retorno['foto']   = $info['foto'];
                $retorno['criado']   = $info['criado'];
                $retorno['modificado']   = $info['modificado'];
            }
            $this->set( 'info_usuario', $retorno );
        }

        if( $this->request->is( 'post' ) ) {


            $table = $this->Usuarios->get( $usuario_id );
            $table->modificado = date("Y-m-d H:i:s");

            $arquivo = $this->request->getData()['foto'];

            if( ! empty( $arquivo['tmp_name'] ) ) {

                if( $arquivo['size'] > 1000000) {
                    $this->Flash->error( __( 'Imagem muito grande, use no máximo 1MB' ) );
                    return $this->redirect([
                        'controller'    =>  'Usuarios',
                        'action'        =>  'editar'
                    ]);
                }

                $mime_type = [ 'image/png', 'image/jpeg', 'image/jpg' ];

                if( ! in_array( $arquivo['type'], $mime_type ) ) {
                    $this->Flash->error( __( 'Formato de imagem inválido' ) );
                    return $this->redirect([
                        'controller'    =>  'Usuarios',
                        'action'        =>  'editar'
                    ]);
                }

                switch( $arquivo['type'] ) {
                    case "image/png" :
                        $ext = ".png";
                        break;

                    case "image/jpeg" :
                        $ext = ".jpge";
                        break;

                    case "image/jpg" :
                        $ext = ".png";
                        break;
                }

                $novo_nome = md5( uniqid( rand(), true ) ) . $ext;

                if( ! move_uploaded_file( $arquivo['tmp_name'], WWW_ROOT . 'img' . DS . 'UsuariosAvatar' . DS . $novo_nome ) )
                {
                    $this->Flash->error( __( 'Erro ao importa imagem.' ) );
                }
                else {
                    $table->foto = $novo_nome;
                }
            }

            $edit_nome = $this->request->getData()['nome'];
            $edit_email = $this->request->getData()['email'];

            if( ! empty( $this->request->getData()['senha'] ) ) {
                $hasher = new DefaultPasswordHasher();
                $edit_senha = $hasher->hash( $this->request->getData()['senha'] );
                $table->senha = $edit_senha;
            }

            if( ! empty( $edit_nome ) ) {
                $table->nome = $edit_nome;
            }

            if( ! empty( $edit_email ) ) {
                $table->email = $edit_email;
            }


            if( $this->Usuarios->save( $table ) ) {
                $this->Flash->success( __( 'Perfil atualizado com sucesso!' ) );
            }
            else {
                $this->Flash->error( __( 'Erro ao atualizar o seu perfil!' ) );
            }

            return $this->redirect([
                'controller' => 'Usuarios',
                'action'    =>  'editar'
            ]);
        }
    }

    public function logout ()
    {
        $this->Flash->success( 'Você foi desconectado.' );
        return $this->redirect( $this->Auth->logout() );
    }
}
