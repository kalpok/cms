<?php

namespace modules\user\frontend\controllers;

use Yii;
use yii\web\Controller;
use modules\user\frontend\models\RegisterForm;
use modules\user\common\components\UserIdentity;

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
            $user = UserIdentity::findByEmail($model->email);
            if(Yii::$app->user->login($user, 3600 * 24 * 14)){
                dd('logged in');
            }
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }
}
