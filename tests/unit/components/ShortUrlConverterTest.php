<?php

namespace app\tests\unit\components;

use app\components\ShortUrlConverter;
use Codeception\Test\Unit;

class ShortUrlConverterTest extends Unit
{
    /**
     * Tests method toShortUrl() with given parameters.
     *
     * @dataProvider provideToShortUrlTestData
     * @param string $expected Expected result
     * @param int $id Given identifier
     */
    public function testToShortUrl(string $expected, int $id): void
    {
        $converter = new ShortUrlConverter();
        $this->assertEquals($expected, $converter->toShortUrl($id));
    }

    /**
     * Provides test data for testing method toShortUrl().
     *
     * @return array
     */
    public function provideToShortUrlTestData(): array
    {
        return [
            [
                '0',
                0,
            ],
            [
                '1',
                1,
            ],
            [
                'A',
                10,
            ],
            [
                'Z',
                35,
            ],
            [
                'a',
                36,
            ],
            [
                'z',
                61,
            ],
            [
                '10',
                62,
            ],
            [
                'ZZ',
                2205,
            ],
            [
                'zz',
                3843,
            ],
            [
                '6vPuv',
                102342341,
            ],
        ];
    }
}