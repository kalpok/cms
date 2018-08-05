<?php

namespace core\grid;

use Yii;
use yii\helpers\Html;

class AjaxActionColumn extends ActionColumn
{
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                return Html::a(
                    '<span class="glyphicon glyphicon-eye-open"></span>',
                    $url,
                    [
                        'title' => Yii::t('yii', 'View'),
                        'data-pjax' => '0',
                        'class' => 'ajaxview'
                    ]
                );
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                return Html::a(
                    '<span class="glyphicon glyphicon-pencil"></span>',
                    $url,
                    [
                        'title' => Yii::t('yii', 'Update'),
                        'data-pjax' => '0',
                        'class' => 'ajaxupdate'
                    ]
                );
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                return Html::a(
                    '<span class="glyphicon glyphicon-trash"></span>',
                    $url,
                    [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirmmsg' => Yii::t(
                            'yii',
                            'Are you sure you want to delete this item?'
                        ),
                        'data-pjax' => '0',
                        'class' => 'ajaxdelete'
                    ]
                );
            };
        }
    }
}
