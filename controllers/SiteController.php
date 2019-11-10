<?php

namespace app\controllers;

use app\components\ShortUrlConverter;
use app\models\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Url();

        if ($model->load(\Yii::$app->request->post(), '') && $model->validate()) {
            $model->save(false);
            \Yii::$app->session->addFlash('shortUrl', $model->getShortUrl());
            return $this->refresh();
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    /**
     * Redirects from given short URL to stored long URL.
     *
     * @param string $shortUrl Short URL
     * @return Response
     */
    public function actionShortUrl(string $shortUrl)
    {
        $converter = new ShortUrlConverter();
        $id = $converter->toID($shortUrl);
        $model = Url::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $this->redirect($model->long_url);
    }
}
