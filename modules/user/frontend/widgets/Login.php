<?php
namespace modules\user\frontend\widgets;

use yii;
use yii\base\Widget;
use modules\user\common\models\LoginForm;

class Login extends Widget
{
    public function run()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        return $this->render('login', [
            'model' => $model,
        ]);
    }
}
