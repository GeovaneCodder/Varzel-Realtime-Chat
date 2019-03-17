<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ComentariosTable extends Table
{

    public function initialize ( array $config )
    {

        $this->belongsTo('Usuarios', [
            'className' => 'Usuarios',
            'foreignKey' => 'usuario_id'
        ]);
    }
}
