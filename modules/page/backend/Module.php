<?php
namespace modules\page\backend;

use modules\page\backend\models\Page;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'modules\page\backend\controllers';

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
