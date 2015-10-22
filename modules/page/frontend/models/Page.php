<?php
namespace aca\page\frontend\models;

use Yii;
use aca\page\common\models\Page as basePage;
use yii\db\ActiveQuery;
use aca\fileManager\frontend\behaviors\FileBehavior;

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
            'websiteId = :id AND isActive = 1',
            [':id' => Yii::$app->website->id]
        );
        return $query;
    }
}
