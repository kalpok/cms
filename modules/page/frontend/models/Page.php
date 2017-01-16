<?php
namespace modules\page\frontend\models;

use Yii;
use yii\db\ActiveQuery;
use extensions\file\behaviors\FileBehavior;
use modules\page\common\models\Page as basePage;

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
        if (Yii::$app->i18n->isMultiLanguage()) {
            $query->andWhere(
                ['like', 'language', Yii::$app->language]
            );
        }
        return $query;
    }
}
