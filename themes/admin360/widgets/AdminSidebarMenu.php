<?php
namespace core\widgets;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class AdminSidebarMenu extends \yii\widgets\Menu
{
    public $iconTemplate = '<i class="fa fa-{icon}"></i>';
    public $tagTemplate = '<i class="{type} pull-right flip">{value}</i>';
    public $linkTemplate = '<a href="{url}">{icon} <span>{label}</span> {tag}</a>';

    public function run()
    {
        $this->items = $this->getMenuItems();
        parent::run();
    }

    protected function renderItem($item)
    {
        if (isset($item['url']) or isset($item['items'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
            $iconTemplate = $this->setIconTemplate($item);
            $tagTemplate = $this->setTagTemplate($item);
            return strtr(
                $template,
                [
                    '{icon}' => $iconTemplate,
                    '{tag}'=> $tagTemplate,
                    '{url}' => isset($item['url']) ? Html::encode(Url::to($item['url'])) : '#',
                    '{label}' => $item['label'],
                ]
            );
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);
            return strtr(
                $template,
                [
                    '{label}' => $item['label'],
                ]
            );
        }
    }

    private function setIconTemplate($item)
    {
        $iconTemplate = ArrayHelper::getValue($item, 'iconTemplate', $this->iconTemplate);
        if (isset($item['icon'])) {
            $iconTemplate = strtr($iconTemplate, ['{icon}'=>$item['icon']]);
        } else {
            $iconTemplate = strtr($iconTemplate, ['{icon}'=>'circle-o']);
        }
        return $iconTemplate;
    }

    private function setTagTemplate($item)
    {
        $tagTemplate = ArrayHelper::getValue($item, 'tagTemplate', $this->tagTemplate);
        if (isset($item['tag'])) {
            $tagTemplate = strtr(
                $tagTemplate,
                [
                    '{type}' => 'label label-'.$item['tag']['type'],
                    '{value}' => $item['tag']['value']
                ]
            );
        } elseif (isset($item['items'])) {
            $tagTemplate = strtr(
                $tagTemplate,
                [
                    '{type}' => 'fa fa-angle-left',
                    '{value}' => ''
                ]
            );
        } else {
            $tagTemplate = '';
        }
        return $tagTemplate;
    }

    private function getMenuItems()
    {
        $modules = array_keys(Yii::$app->getModules());
        foreach ($modules as $moduleId) {
            $module = Yii::$app->getModule($moduleId);
            if (!empty($module->menu)) {
                $items[] = $module->menu;
            }
        }
        return $items;
    }
}
