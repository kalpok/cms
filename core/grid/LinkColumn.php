<?php
namespace core\grid;

use yii\helpers\Html;
use yii\grid\DataColumn;

class LinkColumn extends DataColumn
{
    public function init()
    {
        if (!isset($this->attribute)) {
            $this->attribute = 'link';
        }
        $this->format = 'raw';
        $this->filter = false;
        $this->value = function ($model) {
            if (null == $model->{$this->attribute}) {
                return;
            }
            return Html::a(
                'تست لینک',
                $model->{$this->attribute},
                ['target'=>'_blank']
            );
        };
    }
}
