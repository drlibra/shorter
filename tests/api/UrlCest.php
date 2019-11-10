<?php

namespace app\tests\functional;

use app\models\Url;

class UrlCest
{
    /**
     * Check creation of new short URL.
     *
     * @param \ApiTester $I Tester
     */
    public function createNewShortUrl(\ApiTester $I): void
    {
        $I->sendPOST('api/url', ['long_url' => 'http://www.google.ru']);
        $I->seeResponseCodeIs(201);
        $I->seeResponseContainsJson([
            'long_url' => 'http://www.google.ru',
        ]);
    }

    /**
     * Check deleting URL.
     *
     * This test is not applicable due to possible issue in Yii2 connector in Codeception:
     * https://github.com/Codeception/Codeception/issues/5744
     *
     * @skip
     * @param \ApiTester $I Tester
     */
    public function deleteUrl(\ApiTester $I): void
    {
        $modelData = ['id' => 140, 'long_url' => 'test_url'];
        \Yii::$app->db->createCommand()->insert(Url::tableName(), $modelData)->execute();

        $I->sendDELETE('api/url/' . $modelData['id']);
        $I->seeResponseCodeIs(204);
    }

    /**
     * Check viewing URL.
     *
     * @param \ApiTester $I Tester
     */
    public function viewUrl(\ApiTester $I): void
    {
        $modelData = ['id' => 140, 'long_url' => 'test_url'];
        \Yii::$app->db->createCommand()->insert(Url::tableName(), $modelData)->execute();

        $I->sendGET('api/url/' . $modelData['id']);
        $I->seeResponseCodeIs(200);
        $modelData['short_url'] = 'http://localhost/2G';
        $I->seeResponseContainsJson($modelData);
    }

    /**
     * Check validation error when no long URL is sent.
     *
     * @param \ApiTester $I Tester
     */
    public function sendEmptyLongUrl(\ApiTester $I): void
    {
        $I->sendPOST('api/url');
        $I->seeResponseCodeIs(422);
        $I->seeResponseContainsJson([
            "field" => "long_url",
            "message" => "Long Url cannot be blank.",
        ]);
    }
}