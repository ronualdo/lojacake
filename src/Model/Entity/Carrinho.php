<?php
    namespace App\Model\Entity;

    use Cake\ORM\Entity;
    use Cake\ORM\TableRegistry;

    class Carrinho extends Entity {
        protected $_accessible = [
            'user_id' => true,
        ];

        public  $valorTotal = 0.0;

        public function add($produtoId, $quantidade) {
            $produto = $this->Produtos->get($produtoId);
            $this->valorTotal += $produto['valor'];
        }
    }
