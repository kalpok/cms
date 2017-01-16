<?php
namespace core\grid;

use yii\helpers\Html;
use yii\grid\DataColumn;

class TitleColumn extends DataColumn
{
    public function init()
    {
        if (!isset($this->attribute)) {
            $this->attribute = 'title';
        }
        $this->format = 'raw';
        $this->value =
        function ($model) {
            $attribute = $this->attribute;
            return Html::a($model->$attribute, ['view', 'id'=>$model->id]);
        };
    }
}
