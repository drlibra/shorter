<?php

namespace app\components;

use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

class ShortUrlConverter extends BaseObject
{
    /**
     * @var array Symbols is used to create short URL
     */
    private $symbols;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        $this->symbols = ArrayHelper::merge(
            ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
            range('A', 'Z'),
            range('a', 'z')
        );
    }

    /**
     * Translates given identifier to short url.
     *
     * @param int $id Identifier
     * @return string
     */
    public function toShortUrl(int $id): string
    {
        $remainder = $id;
        $symbolsCount = count($this->symbols);
        $maxRemainder = $symbolsCount - 1;
        $shortUrl = '';
        while ($remainder > $maxRemainder) {
            $modulus = $remainder % $symbolsCount;
            $remainder = intdiv($remainder, $symbolsCount);
            $shortUrl = $this->symbols[$modulus] . $shortUrl;
        }

        return $this->symbols[$remainder] . $shortUrl;
    }
}