<?php
namespace modules\page\frontend\models;

use Yii;
use modules\page\common\models\Page as basePage;
use yii\db\ActiveQuery;
use kalpok\file\behaviors\FileBehavior;

class Page extends basePage
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => FileBehavior::className(),
                    'groups' => [
                        'image' => [
                            'type' => FileBehavior::TYPE_IMAGE,
                        ],
                    ]
                ]
            ]
        );
    }

    public static function find()
    {
        $query = new ActiveQuery(get_called_class());
        $query->andWhere(
            'isActive = 1'
        );
        return $query;
    }
}
