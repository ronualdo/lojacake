<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProdutosTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('nome', true, "campo nome e obrigatorio")
            ->requirePresence('valor', true, "campo valor e obrigatorio");

        return $validator;
    }
}