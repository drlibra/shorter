<?php

namespace app\models;

use app\components\ShortUrlConverter;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url as UrlHelper;

/**
 * Information about saved URL.
 *
 * @property int $id Identifier
 * @property string $long_url Long URL
 */
class Url extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['long_url', 'required'],
            ['long_url', 'url'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields(): array
    {
        return ArrayHelper::merge(
            parent::fields(),
            [
                'short_url' => [$this, 'getShortUrl'],
            ]
        );
    }

    /**
     * Returns short url.
     *
     * @return string
     */
    public function getShortUrl(): string
    {
        $converter = new ShortUrlConverter();

        return UrlHelper::to($converter->toShortUrl($this->id), true);
    }
}