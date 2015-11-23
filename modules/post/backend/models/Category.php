<?php

namespace modules\post\backend\models;

use Yii;
use kalpok\behaviors\TimestampBehavior;
use kalpok\behaviors\SluggableBehavior;

class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_category';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'createdAt', 'updatedAt'], 'required'],
            [['description'], 'string'],
            [['createdAt', 'updatedAt', 'isActive'], 'integer'],
            [['title', 'language', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'language' => 'Language',
            'slug' => 'Slug',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'isActive' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategoryRelations()
    {
        return $this->hasMany(PostCategoryRelation::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'postId'])->viaTable('post_category_relation', ['categoryId' => 'id']);
    }
}
