<?php

namespace aca\page\frontend;

class Module extends \yii\base\Module
{
    public $urlRules;
    public $controllerNamespace = 'aca\page\frontend\controllers';

    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
