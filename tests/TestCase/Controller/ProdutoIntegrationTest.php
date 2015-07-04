<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

class ProdutoIntegrationTest extends IntegrationTestCase
{
    public $fixtures = ['app.produtos'];

    public function testDeveInformarQuandoProdutoFoiCriadoComSucesso()
    {
        $produto = [
            'nome' => 'Caneta',
            'valor' => 12.5
        ];

        $this->post('/produtos.json', $produto);

        $this->assertResponseCode(200);
        $this->assertResponseContains('"id":');
        $this->assertResponseContains('"nome": "Caneta"');
        $this->assertResponseContains('"valor": 12.5');
    }

    public function testDeveInformarQuandoProdutoNaoPossuirNome()
    {
        $produto = [
            'valor' => 12.5
        ];

        $this->post('/produtos.json', $produto);

        $this->assertResponseCode(400);
        $this->assertResponseContains('campo nome e obrigatorio');
    }

    public function testDeveInformarQuandoProdutoNaoPossuirValor()
    {
        $produto = [
            'nome' => 'Caneta'
        ];

        $this->post('/produtos.json', $produto);

        $this->assertResponseCode(400);
        $this->assertResponseContains('campo valor e obrigatorio');
    }

    public function testDeveRetornarProdutoCadastradoAnteriormente()
    {

        $this->get('/produtos/1.json');

        $this->assertResponseCode(200);
        $this->assertResponseContains('"id": 1');
    }
}



