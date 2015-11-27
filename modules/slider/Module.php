<?php

namespace modules\slider;

class Module extends \yii\base\Module
{

    public $title;
    public $menu;
    public $defaultRoute = 'manage/home-fa';
    public $controllerNamespace = 'modules\slider\controllers';

    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
