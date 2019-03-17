<?php

namespace App\Controller;

class ComentariosController extends AppController
{

    public function index ()
    {

        $this->paginate = [
            'limit' =>  10
        ];

        $comentarios = $this->paginate( $this->Comentarios->find()
                                         ->contain(['usuarios'])
                                         ->order(['Comentarios.id' => 'DESC']));

        $this->set( 'comentarios', $comentarios );
    }

    public function add ()
    {
        $this->autoRender = false;
        $this->request->allowMethod('ajax');

        $gravar_comentario = $this->Comentarios->newEntity();

        if ($this->request->is('ajax') ) {
            $gravar_comentario = $this->Comentarios->patchEntity( $gravar_comentario, $this->request->data() );
            $gravar_comentario->usuario_id = $this->request->getSession()->read('Auth.User.id');
            $gravar_comentario->comentario = htmlentities( $this->request->data()['comentario'] );
            $gravar_comentario->criacao = date("Y-m-d H:i:s");
            if( $this->Comentarios->save( $gravar_comentario ) ) {
                echo 'ajax_sucesso_gravar';
                exit();
            }
            else {
                echo 'ajax_erro_gravar';
            }
        }
    }

    public function editar ( $id )
    {
        $this->autoRender = false;
        $this->request->allowMethod('ajax');       

        if ($this->request->is('ajax') ) {
            $table = $this->Comentarios->get( $id );
            $table->modificado = date("Y-m-d H:i:s");
            $table->comentario = htmlentities( $this->request->data()['comentario'] );
            if( $this->Comentarios->save( $table ) ) {
                $this->Flash->success( __( 'Comentário editado com sucesso!' ) );
            }
            else {
                $this->Flash->error( __( 'Erro ao editado o comentário!' ) );
            }
        }
    }

    public function deletar ( $id )
    {
        $this->autoRender = false;
        $this->request->allowMethod('ajax');

        if( $this->request->is( 'ajax' ) ) {
            $comentario_delete = $this->Comentarios->get( $id );
            if( $this->Comentarios->delete( $comentario_delete ) ) {
                $this->Flash->success( __( 'Comentário deletado com sucesso!' ) );
            }
            else {
                $this->Flash->error( __( 'Erro ao deletar o comentário!' ) );
            }
        }
    }

    public function listarMeusComentarios ()
    {
        $this->paginate = [
            'limit' =>  10
        ];

        if( $this->request->getSession()->read('Auth.User.admin') ) {
            $comentarios = $this->paginate( $this->Comentarios->find()
                                             ->contain(['usuarios'])
                                             ->order(['Comentarios.id' => 'DESC']));
        }
        else {
            $comentarios = $this->paginate( $this->Comentarios->find()
                                             ->contain(['usuarios'])
                                             ->where(['usuario_id' => $this->request->getSession()->read('Auth.User.id')])
                                             ->order(['Comentarios.id' => 'DESC']));
        }

        $this->set( 'comentarios', $comentarios );
    }

    public function buscar() {

        if( $this->request->getData()['buscar'] ) {

            $remover = ["'", '"', '-', ';'];

            $nome = str_ireplace( $remover, '', $this->request->getData()['buscar'] );

            $comentarios = $this->paginate( $this->Comentarios->find()
                                             ->contain(['usuarios'])
                                             ->where(['Usuarios.nome LIKE' => "%" . $nome . "%"])
                                             ->order(['Comentarios.id' => 'DESC']));

            $this->set( 'comentarios', $comentarios );
        }
    }
}
