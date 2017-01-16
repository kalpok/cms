<?php
namespace core\grid;

use yii\grid\DataColumn;

class ActiveColumn extends DataColumn
{
    public function init()
    {
        if (!isset($this->attribute)) {
            $this->attribute = 'isActive';
        }
        $this->format = 'boolean';
        $this->filter = [
            '1' => 'بله',
            '0' => 'خیر'
        ];
        $this->options = [
            'style' => 'width:10%;'
        ];
    }
}
