<?php

namespace core\modules\user\frontend;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'core\modules\user\frontend\controllers';
    public $defaultRoute = 'front/index';

    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
