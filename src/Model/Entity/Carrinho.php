<?php
    namespace App\Model\Entity;

    use Cake\ORM\Entity;

    class Carrinho extends Entity {
        protected $_accessible = [
            'user_id' => true,
        ];

        public $valorTotal      = 0.0;
        public $quantidadeTotal = 0;
        public $itens           = [];

        public function add($produtoId, $quantidade) {

            $produto = $this->Produtos->get($produtoId);
            $itemNew = new Item($produtoId, $quantidade);

            $itemsFound = array_filter($this->itens,function($item) use($itemNew){
               return $item->produtoId == $itemNew->produtoId;
            });

            if (!empty($itemsFound)) {
                $itemsFound[0]->quantidade += $quantidade;
            } else {
                $this->itens[] = $itemNew;
            }

            $this->valorTotal += $produto['valor'] * $quantidade;
        }

        public function getItems() {
            return $this->itens;
        }

        public function getQuantidadeTotal() {
            return count($this->itens);
        }
    }
