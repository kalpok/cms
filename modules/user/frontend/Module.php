<?php

namespace modules\user\frontend;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modules\user\frontend\controllers';
    public $defaultRoute = 'front/index';
    public $controllerMap = [
        'auth' => [
           'class' => 'modules\user\common\controllers\AuthController'
        ],
    ];

    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
