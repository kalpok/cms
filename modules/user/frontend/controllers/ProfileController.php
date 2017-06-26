<?php

namespace modules\user\frontend\controllers;

use Yii;
use yii\web\Controller;
use modules\user\frontend\models\User;

class ProfileController extends Controller
{
    public function actionView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $user = User::findOne(Yii::$app->user->id);
        var_dump($user->profile[0]->data);
        return $this->render('view'); //Yii::$app->user->id;
    }

    public function actionUpdate()
    {
    }
}
