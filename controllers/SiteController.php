<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => 'error'
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->params['app'] == 'backend' && Yii::$app->user->isGuest) {
            Yii::$app->user->loginRequired();
        }
        return $this->render('index-'.Yii::$app->language);
    }
}
