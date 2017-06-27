<?php

namespace modules\user\frontend\controllers;

use Yii;
use yii\web\Controller;
use modules\user\frontend\models\User;
use modules\user\frontend\models\Profile;

class ProfileController extends Controller
{
    public function actionView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $user = User::findOne(Yii::$app->user->id);
        return $this->render('view', ['user' => $user]);
    }

    public function actionUpdate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $user = User::findOne(Yii::$app->user->id);
        return $this->render('update', ['user' => $user]);
    }
}
