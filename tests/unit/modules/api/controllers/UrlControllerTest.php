<?php

namespace app\tests\unit\modules\api\controllers;

use app\models\Url;
use app\modules\api\controllers\UrlController;
use Codeception\Test\Unit;

class UrlControllerTest extends Unit
{
    /**
     * Tests index action.
     */
    public function testCreateUrl(): void
    {
        $controller = new UrlController('mu', \Yii::$app);
        $controller->detachBehaviors();
        \Yii::$app->controller = $controller;
        \Yii::$app->request->setBodyParams(['long_url' => 'http://www.ya.ru']);

        $response = $controller->runAction('create');
        $this->assertArrayHasKey('long_url', $response);
        $this->assertArrayHasKey('short_url', $response);
        $this->assertArrayHasKey('id', $response);
    }

    /**
     * Tests viewing model.
     */
    public function testViewUrl(): void
    {
        $modelData = ['id' => 140, 'long_url' => 'test_url'];
        \Yii::$app->db->createCommand()->insert(Url::tableName(), $modelData)->execute();

        $controller = new UrlController('mu', \Yii::$app);
        $controller->detachBehaviors();

        $response = $controller->runAction('view', ['id' => $modelData['id']]);
        $modelData['short_url'] = 'http://localhost/2G';
        $this->assertEquals($modelData, $response);
    }

    /**
     * Tests deleting model.
     */
    public function testDeleteUrl(): void
    {
        $modelData = ['id' => 140, 'long_url' => 'test_url'];
        \Yii::$app->db->createCommand()->insert(Url::tableName(), $modelData)->execute();
        $controller = new UrlController('mu', \Yii::$app);
        $controller->detachBehaviors();

        $controller->runAction('delete', ['id' => $modelData['id']]);
        $this->assertNull(Url::findOne($modelData['id']));
    }
}