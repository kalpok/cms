<?php
namespace core\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use core\widgets\Button;

class ActionButtons extends Widget
{
    public $buttons;
    public $modelID = null;
    public $visibleFor = null;
    private $defaultIcon = 'caret-square-o-left';
    private $defaultLabel = 'دکمه';
    private $defaultType = 'primary';

    public function run()
    {
        echo '<div class="row">';
        echo '<div class="col-sm-12">';
        foreach ($this->buttons as $action => $btnOptions) {
            $visibleFor = (empty($btnOptions['visibleFor'])) ? null : $btnOptions['visibleFor'];
            $options = (empty($btnOptions['options'])) ? [] : $btnOptions['options'];
            Html::addCssClass($options, 'btn-app');
            switch ($action) {
                case 'create':
                    $label = (empty($btnOptions['label'])) ? 'افزودن' :  $btnOptions['label'] ;
                    echo Button::widget([
                        'url' => ['create'],
                        'label' => $label,
                        'options' => $options,
                        'icon' => 'plus',
                        'type' => 'success',
                        'visibleFor' => $visibleFor ,
                     ]);
                    break;
                case 'update':
                    $label = (empty($btnOptions['label'])) ? 'ویرایش' :  $btnOptions['label'] ;
                    echo Button::widget([
                        'url'=> ['update', 'id' => $this->modelID],
                        'label' => $label,
                        'options' => $options,
                        'icon' => 'edit',
                        'type' => 'primary',
                        'visibleFor' => $visibleFor,
                     ]);

                    break;
                case 'delete':
                    $label = (empty($btnOptions['label'])) ? 'حذف' :  $btnOptions['label'] ;
                    echo Button::widget([
                        'url'=> ['delete', 'id' => $this->modelID],
                        'label' => $label,
                        'icon' => 'times',
                        'type' => 'danger',
                        'visibleFor' => $visibleFor,
                        'options' => array_merge($options, [
                             'data' => [
                             'confirm' => 'آیا برای حذف مطمئن هستید؟',
                             'method' => 'post',
                             ]
                        ])
                     ]);
                    break;
                case 'index':
                     $label = (empty($btnOptions['label'])) ? 'مدیریت' :  $btnOptions['label'] ;
                     echo Button::widget([
                        'url'=> ['index'],
                        'label' => $label,
                        'icon' => 'tasks',
                        'type' => 'info',
                        'visibleFor' => $visibleFor,
                        'options' =>  $options
                     ]);
                    break;
                case 'categoriesIndex':
                     $label = (empty($btnOptions['label'])) ? 'مدیریت دسته ها' :  $btnOptions['label'] ;
                     echo Button::widget([
                        'url'=> ['category/index'],
                        'label' => $label,
                        'icon' => 'tasks',
                        'type' => 'warning',
                        'visibleFor' => $visibleFor,
                        'options' =>  $options
                     ]);
                    break;
                default:
                    $button = $this->setOptions($btnOptions);
                    echo Button::widget([
                        'url'=> $button['url'],
                        'label' => $button['label'],
                        'icon' =>  $button['icon'],
                        'type' =>  $button['type'],
                        'visibleFor' => $visibleFor,
                        'options' => $options
                     ]);
                    break;
            }
        }
        echo "</div>";
        echo "</div>";
    }
    private function setOptions($btnOptions)
    {
        $btnOptions['label'] = (isset($btnOptions['label'])) ? $btnOptions['label'] :
            $this->defaultLabel ;
        $btnOptions['icon'] = (isset($btnOptions['icon'])) ? $btnOptions['icon'] :
            $this->defaultIcon ;
        $btnOptions['type'] = (isset($btnOptions['type'])) ? $btnOptions['type'] :
            $this->defaultType ;
        return $btnOptions;
    }
}
