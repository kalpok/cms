<?php
namespace core\grid;

use yii\grid\DataColumn;

class IDColumn extends DataColumn
{
    public function init()
    {
        if (!isset($this->attribute)) {
            $this->attribute = 'id';
        }
        $this->format = 'farsiNumber';
        $this->options = [
            'style' => 'width:10%;'
        ];
    }
}
