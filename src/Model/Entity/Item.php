<?php
    namespace App\Model\Entity;

    use Cake\ORM\Entity;

    class Item extends Entity {

        public $produtoId;
        public $quantidade;

        public function __construct($produtoId, $quantidade){
            $this->produtoId = $produtoId;
            $this->quantidade = $quantidade;
        }

        public function __toString()
        {
            return "[id:$this->produtoId,\0quantidade:$this->quantidade]";
        }
    }