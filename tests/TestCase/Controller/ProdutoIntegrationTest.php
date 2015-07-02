<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

class ProdutoIntegrationTest extends IntegrationTestCase
{

    public function testDeveInformarQuandoProdutoFoiCriadoComSucesso()
    {
        $produto = [
            'nome' => 'Caneta',
            'valor' => 12.5
        ];

        $this->post('/produto.json', $produto);

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

        $this->post('/produto.json', $produto);

        $this->assertResponseCode(400);
        $this->assertResponseContains('"mensagem": "campo nome e obrigatorio"');
    }

    public function testDeveInformarQuandoProdutoNaoPossuirValor()
    {
        $produto = [
            'nome' => 'Caneta'
        ];

        $this->post('/produto.json', $produto);

        $this->assertResponseCode(400);
        $this->assertResponseContains('"mensagem": "campo valor e obrigatorio"');
    }
}



