<?php

namespace app\tests\api;

use app\models\Url;

class SiteCest
{
    /**
     * Tests opening short URL.
     *
     * @param \ApiTester $I Tester
     */
    public function openShortUrl(\ApiTester $I): void
    {
        $modelData = ['id' => 140, 'long_url' => 'http://localhost/test_url'];
        \Yii::$app->db->createCommand()->insert(Url::tableName(), $modelData)->execute();

        $I->stopFollowingRedirects();
        $I->sendGET('/2G');
        $I->seeResponseCodeIsRedirection();
        $I->seeHttpHeader('Location', 'http://localhost/test_url');
    }
}
