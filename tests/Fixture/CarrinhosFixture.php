<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CarrinhosFixture extends TestFixture
{
    public $fields = [
        'id' => ['type' => 'integer'],
        'user_id' => ['type' => 'integer'],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
        ]
    ];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1
            ]
        ];
        parent::init();
    }
}