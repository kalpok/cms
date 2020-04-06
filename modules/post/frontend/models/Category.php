<?php

namespace modules\post\frontend\models;

use Yii;

class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post_category}}';
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'postId'])
            ->viaTable('post_category_relation', ['categoryId' => 'id']);
    }

    public static function find()
    {
        $query = new \yii\db\ActiveQuery(get_called_class());
        $query->andWhere(
            'post_category.isActive = 1'
        );
        if (Yii::$app->i18n->isMultiLanguage()) {
            $query->andWhere(
                ['like', 'post_category.language', Yii::$app->language]
            );
        }
        return $query;
    }
}
