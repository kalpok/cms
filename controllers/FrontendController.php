<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => '@app/views/error.php'
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('@app/views/index.php');
    }
}
