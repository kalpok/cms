<?php

namespace modules\page\frontend\controllers;

use yii\web\Controller;
use modules\page\frontend\models\Page;
use yii\web\NotFoundHttpException;

class FrontController extends Controller
{
    public $layout = '//two-column';

    public function actionView($slug)
    {
        $page = Page::find()
            ->andWhere(['slug'=>$slug])
            ->one();
        if ($page == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('view', [
            'page' => $page,
        ]);
    }
}
