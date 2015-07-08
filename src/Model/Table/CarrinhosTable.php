<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CarrinhosTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('user_id', true, "campo user_id e obrigatorio");

        return $validator;
    }
}