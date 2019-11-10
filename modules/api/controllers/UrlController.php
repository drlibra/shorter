<?php

namespace app\modules\api\controllers;

use app\models\Url;
use yii\rest\ActiveController;

class UrlController extends ActiveController
{
    /**
     * @inheritdoc
     */
    public $modelClass = Url::class;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['rateLimiter']);

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);

        return $actions;
    }
}
