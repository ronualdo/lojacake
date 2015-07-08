<?php

namespace App\Controller;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class CarrinhosController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function add()
    {
        $mensagem = '';
        $carrinhos = TableRegistry::get('Carrinhos');
        $carrinho = $carrinhos->newEntity($this->request->data());
        if ($carrinho->errors()) {
            $this->response->statusCode(400);
            $mensagem = $carrinho->errors();
        }else {
            $this->Carrinhos->save($carrinho);
        }

        $this->set(compact('carrinho', 'mensagem'));
        $this->set('_serialize', ['carrinho', 'mensagem']);
    }

    public function adicionarProdutos($id) {

        $produtos = TableRegistry::get('Produtos');
        $carrinhos = TableRegistry::get('Carrinhos');
        $carrinho = $carrinhos->get($id);
        $carrinho->set('Produtos', $produtos);

        $produtos = $this->request->data("produtos");

        foreach ($produtos as $produto) {
            $carrinho->add($produto['id'], $produto['quantidade']);
        }

        $carrinhos->save($carrinho);

        $this->set(compact('carrinho'));
        $this->set('_serialize', ['carrinho']);
    }

}