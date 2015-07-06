<?php
use Phinx\Migration\AbstractMigration;

class CriarProdutos extends AbstractMigration
{

    public function change()
    {
        $this->table('produtos')
            ->addColumn('nome', 'string')
            ->addColumn('valor', 'decimal')
            ->create();
    }
}
