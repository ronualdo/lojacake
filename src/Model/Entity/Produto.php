<?php
    namespace App\Model\Entity;

    use Cake\ORM\Entity;
    class Produto extends Entity {
        protected $_accessible = [
            'user_id' => true,
        ];
    }
