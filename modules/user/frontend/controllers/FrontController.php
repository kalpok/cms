<?php

namespace modules\user\frontend\controllers;

use Yii;
use yii\web\Controller;
use modules\user\frontend\models\RegisterForm;

class FrontController extends Controller
{
    public function actionRegister()
    {
        $model = new RegisterForm;
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'ثبت نام با موفقیت انجام شد.'
            );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }
}
