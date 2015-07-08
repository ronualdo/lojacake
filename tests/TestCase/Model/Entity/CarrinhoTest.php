<?php
    namespace App\Test\TestCase\Model\Entity;

    use App\Model\Entity\Carrinho;
    use Cake\TestSuite\TestCase;
    use App\Model\Entity\Item;

    class CarrinhoTest extends TestCase {

        public function setUp() {
            parent::setUp();

            $map = [
                [1, ['id' => 1, 'valor' => 12.5]],
                [2,['id' => 2, 'valor' => 11.0]],
                [3, ['id' => 3, 'valor' => 10.0]]
            ];

            $produtosRepository = $this->getMock('ProdutosTable', ['get']);
            $produtosRepository
                ->method('get')
                ->will($this->returnValueMap($map));

            $this->Carrinho = new Carrinho();
            $this->Carrinho->set('Produtos', $produtosRepository);
        }

        public function tearDown() {
            unset($this->Carrinho);

            parent::tearDown();
        }

        public function testCalcularValorTotalDoCarrinhoParaUmProduto() {
            $this->Carrinho->add(1, 1);

            $this->assertEquals(12.5, $this->Carrinho->valorTotal);
        }

        public function testCalcularQuantidadeTotalDoCarrinhoParaVariosProduto() {
            $this->Carrinho->add(1, 1);
            $this->Carrinho->add(2, 1);
            $this->Carrinho->add(3, 1);

            $this->assertEquals(3, $this->Carrinho->getQuantidadeTotal());

            $this->assertTrue(
                $this->hasItems(
                    $this->Carrinho->getItems(),
                    [
                        new Item(1, 1),
                        new Item(2, 1),
                        new Item(3, 1)
                    ]
                ),
                implode(",", $this->Carrinho->getItems())
            );
        }

        private function hasItems($itemsHaystack, $itemsToCheck) {
            $matchedItens = array_filter(
                $itemsToCheck,
                function ($item) use ($itemsHaystack) {
                    return in_array($item, $itemsHaystack);
                }
            );

            return count($matchedItens) == count($itemsToCheck);
        }

        public function testCalcularValorTotalDoCarrinhoParaMaisDeUmProduto() {
            $this->Carrinho->add(1, 2);

            $this->assertEquals(25.0, $this->Carrinho->valorTotal);
        }

        public function testCalcularValorDeProdutosDiferentes(){
            $this->Carrinho->add(1, 10);
            $this->Carrinho->add(2, 3);

            $this->assertEquals(158.0, $this->Carrinho->valorTotal);
        }

        public function testVerificarQuantidadeDeProdutoAoAdicionarMesmoProdutoMaisDeUmaVez(){
            $this->Carrinho->add(1, 10);
            $this->Carrinho->add(1, 3);

            $this->assertEquals(1, $this->Carrinho->getQuantidadeTotal());
        }
    }
