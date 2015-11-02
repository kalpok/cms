<?php

namespace modules\page\frontend\controllers;

use yii\web\Controller;
use modules\page\frontend\models\Page;
use yii\web\NotFoundHttpException;

class FrontController extends Controller
{
    // public $layout = '//two-column';
    public function actionView($id)
    {
        $page = $this->findModel($id);
        return $this->render('view', [
            'page' => $page,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
