<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ProdutosFixture extends TestFixture
{
    public $fields = [
        'id' => ['type' => 'integer'],
        'nome' => ['type' => 'string'],
        'valor' => ['type' => 'decimal'],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
        ]
    ];

    public function init()
    {
        $this->records = [
            [
                'nome' => 'caneta',
                'valor' => 12.5
            ]
        ];
        parent::init();
    }
}