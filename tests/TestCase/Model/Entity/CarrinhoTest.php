<?php
    namespace App\Test\TestCase\Model\Entity;

    use App\Model\Entity\Carrinho;
    use App\Model\Entity\Produto;
    use Cake\TestSuite\TestCase;

    class CarrinhoTest extends TestCase {

        public function setUp() {
            parent::setUp();

            $produtosRepository = $this->getMock('ProdutosTable', ['get']);
            $produtosRepository
                ->method('get')
                ->will($this->returnValue(['id' => 1, 'valor' => 12.5]));

            $this->Carrinho = new Carrinho();
            $this->Carrinho->set('Produtos', $produtosRepository);
        }

        public function tearDown() {
            unset($this->Carrinho);

            parent::tearDown();
        }

        public function testAdicionarProdutoAoCarrinho(){
            $this->Carrinho->add(1, 1);

            $this->assertEquals(12.5, $this->Carrinho->valorTotal);
        }
    }
