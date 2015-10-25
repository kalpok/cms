<?php
namespace modules\page\common\models;

use creocoder\nestedsets\NestedSetsBehavior;

class Page extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'page';
    }

    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'root',
            ],
        ];
    }
}
