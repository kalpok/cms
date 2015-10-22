<?php
namespace core\modules\page\backend;

use core\modules\page\backend\models\Page;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'core\modules\page\backend\controllers';

    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }

    public function feedMenuModule()
    {
        $list = [];
        $pages = Page::find()
            ->andWhere('isActive = 1')
            ->orderBy(['root' => SORT_DESC,'lft' => SORT_ASC])
            ->all();
        foreach ($pages as $page) {
            $list[] = [
                'label' => $page->nestedTitle,
                'route' => 'page/front/view',
                'params' => [
                    'id' => $page->id
                ]
            ];
        }

        return $list;
    }
}
