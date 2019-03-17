<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

class UsuariosTable extends Table
{

    public function initialize ( array $config )
    {
        parent::initialize( $config );

        $this->hasMany('Comentarios', [
            'className' => 'Comentarios',
            'foreignKey' => 'id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('nome')
            ->allowEmpty('nome');
        $validator
            ->email('email')
            ->allowEmpty('email');
        $validator
            ->scalar('senha')
            ->allowEmpty('senha');
        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], 'Email ja está em uso!'));
        return $rules;
    }

}
