<?php

namespace modules\page\frontend;

class Module extends \yii\base\Module
{
    public $urlRules;
    public $controllerNamespace = 'modules\page\frontend\controllers';

    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
