<?php

namespace modules\post\backend;

class Module extends \yii\base\Module
{
	public $title;
    public $menu;
	public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'modules\post\backend\controllers';
    public $editableSlug = false;
    public $isCommentsEnabled = true;
    public $isTagsEnabled = true;

    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));
        if (!$this->isCommentsEnabled) {
            unset($this->menu['items']['comments-link']);
        }
    }
}
