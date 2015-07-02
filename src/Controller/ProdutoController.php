<?php

namespace App\Controller;

use Cake\Controller\Controller;

class ProdutoController extends AppController
{

    private $produtos = [];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function view($id)
    {

    }

    public function add()
    {
        $produto = $this->request->data();

        $isNomeDefined = isset($this->request->data['nome']);
        $isValorDefined = isset($this->request->data['valor']);

        if ( $isNomeDefined && $isValorDefined) {
            $produtos[] = $produto;
            $produto['id'] = "0001";
            $this->set('produto', $produto);
            $this->set('_serialize', ['produto']);
        } else {
            if (!$isNomeDefined) {
                $this->set('mensagem', 'campo nome e obrigatorio');
            }

            if (!$isValorDefined) {
                $this->set('mensagem', 'campo valor e obrigatorio');
            }
            $this->response->statusCode(400);
            $this->set('_serialize', ['mensagem']);
        }
    }
}