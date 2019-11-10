<?php

namespace app\tests\unit\models;

use app\models\Url;
use Codeception\Test\Unit;

class UrlTest extends Unit
{
    /**
     * Tests model serialization.
     */
    public function testToArray(): void
    {
        $model = new Url([
            'id' => 10,
            'long_url' => 'http://www.ya.ru',
        ]);

        $expected = [
            'id' => 10,
            'long_url' => 'http://www.ya.ru',
            'short_url' => 'http://localhost/A',
        ];

        $this->assertEquals($expected, $model->toArray());
    }

    /**
     * Tests model validation.
     */
    public function testValidation(): void
    {
        $model = new Url();
        $this->assertFalse($model->validate());
        $expected = [
            'long_url' => ['Long Url cannot be blank.'],
        ];
        $this->assertEquals($expected, $model->errors);

        $model->long_url = 'not_url';
        $expected = [
            'long_url' => ['Long Url is not a valid URL.'],
        ];
        $this->assertFalse($model->validate());
        $this->assertEquals($expected, $model->errors);

        $model->long_url = 'http://www.google.ru';
        $this->assertTrue($model->validate());
    }
}