<?php
namespace modules\page\common\models;

use creocoder\nestedsets\NestedSetsBehavior;
use kalpok\gallery\behaviors\GalleryBehavior;

class Page extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'page';
    }

    public function behaviors()
    {
        return [
            GalleryBehavior::className(),
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'root',
            ],
        ];
    }
}
