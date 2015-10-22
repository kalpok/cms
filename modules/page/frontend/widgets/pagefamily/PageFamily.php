<?php
namespace aca\page\frontend\widgets\pagefamily;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class PageFamily extends Widget
{
    public $page;
    public $view = 'pageFamily';
    public $title = 'صفحات مرتبط';
    public $icon;
    public $containerClass;
    public $titleClass;
    public $listClass;
    public $listIcon = '-';
    public $showTitle = true;

    public function run()
    {
        $sibling =[];
        $parent=[];
        $children = $this->page->children(1)->all();
        if (!$this->page->isRoot()) {
            $parent = $this->page->parents(1)->one();
            if (!empty($parent)) {
                $sibling = $parent->children(1)->all();
            }
        }
        return $this->render(
            $this->view,
            [
                'page' => $this->page,
                'parent' => $parent,
                'children' => $children,
                'sibling' => $sibling,
            ]
        );
    }
}
