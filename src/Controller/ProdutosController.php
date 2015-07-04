<?php

namespace App\Controller;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class ProdutosController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function view($id)
    {
        $produtos = TableRegistry::get('Produtos');
        $this->set('produto', $produtos->get($id));
        $this->set('_serialize', ['produto']);
    }

    public function add()
    {
        $produtos = TableRegistry::get('Produtos');
        $produto = $produtos->newEntity($this->request->data());

        if ($produto->errors()) {
            $this->response->statusCode(400);
            $this->set('mensagem', $produto->errors());
            $this->set('_serialize', ['mensagem']);
        } else {
            $produtos->save($produto);
            $this->set('produto', $produto);
            $this->set('_serialize', ['produto']);
        }
    }

}