<?php
    namespace App\Test\TestCase\Controller;

    use Cake\TestSuite\IntegrationTestCase;

    /**
     * @group aceitacao
     */
    class CarrinhosIntegrationTest extends IntegrationTestCase {
        public $fixtures = [
            'app.carrinhos',
            'app.produtos'
        ];

        public function testCriarCarrinhoParaUsuario() {
            $carrinho = [
                'user_id' => 1
            ];

            $this->post('/carrinhos/add.json', $carrinho);

            $this->assertResponseCode(200);

            $this->assertResponseContains("\"id\":");
            $this->assertResponseContains("\"user_id\": 1");
        }

        public function testCriarCarrinhoSemUsuario() {
            $carrinho = [];

            $this->post('/carrinhos.json', $carrinho);

            $this->assertResponseCode(400);
            $this->assertResponseContains('campo user_id e obrigatorio');
        }

        public function testAdicionarProdutoAoCarrinho() {

            $carrinho = [
                'user_id'  => 1,
                'produtos' => [
                    ['id' => 1, 'quantidade' => 1]
                ]
            ];

            $this->post('/carrinhos/1/produtos.json', $carrinho);

            $this->assertResponseCode(200);

            $produtos_expected = json_encode([ 'carrinho' => $carrinho ], JSON_PRETTY_PRINT);

            $this->assertResponseContains("\"id\": 1");
            $this->assertResponseContains("\"user_id\": 1");
            $this->assertResponseContains($produtos_expected);
        }

        public function testAdicionarProdutoDeveSomarValorDosProdutosAosCustoTotal() {

            $carrinho = [
                'user_id'  => 1,
                'produtos' => [
                    ['id' => 1, 'quantidade' => 1],
                    ['id' => 2, 'quantidade' => 1]
                ]
            ];

            $this->post('/carrinhos/1/produtos.json', $carrinho);

            $this->assertResponseCode(200);

            $this->assertResponseContains("\"valor_total\": 28.0");
        }
    }



