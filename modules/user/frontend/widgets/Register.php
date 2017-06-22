<?php
namespace modules\user\frontend\widgets;

use yii;
use yii\base\Widget;
use modules\user\common\models\LoginForm;
use modules\user\frontend\models\RegisterForm;

class Register extends Widget
{
    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $model = new RegisterForm;
        $model->loadDefaultValues();
        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
