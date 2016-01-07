<?php

namespace modules\post\frontend\models;

use Yii;
use kalpok\file\behaviors\FileBehavior;

class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            [
                'class' => FileBehavior::className(),
                'groups' => [
                    'image' => [
                        'type' => FileBehavior::TYPE_IMAGE
                    ],
                ]
            ]
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'categoryId'])
            ->viaTable('post_category_relation', ['postId' => 'id']);
    }

    public static function find()
    {
        $query = new \yii\db\ActiveQuery(get_called_class());
        $query->andWhere(
            'post.isActive = 1'
        );
        if (Yii::$app->i18n->isMultiLanguage()) {
            $query->andWhere(
                ['like', 'post.language', Yii::$app->language]
            );
        }
        return $query;
    }
}
