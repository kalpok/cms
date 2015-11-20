<?php

namespace modules\post\backend\models;

use Yii;
use kalpok\behaviors\SluggableBehavior;
use kalpok\behaviors\TimestampBehavior;
use kalpok\file\behaviors\FileBehavior;
use kalpok\behaviors\CategoriesBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $language
 * @property string $slug
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property integer $isActive
 * @property integer $priority
 *
 * @property PostCategoryRelation[] $postCategoryRelations
 * @property PostCategory[] $categories
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            CategoriesBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
            [
                'class' => FileBehavior::className(),
                'groups' => [
                    'image' => [
                        'type' => FileBehavior::TYPE_IMAGE,
                        'rules' => [
                            'extensions' => ['png', 'jpg', 'jpeg'],
                            'maxSize' => 1024*1024,
                        ]
                    ],
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'slug', 'createdAt', 'updatedAt'], 'required'],
            [['summary', 'content'], 'string'],
            [['createdAt', 'updatedAt', 'isActive', 'priority'], 'integer'],
            [['title', 'language', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'summary' => 'خلاصه',
            'content' => 'محتوا',
            'language' => 'زبان',
            'slug' => 'Slug',
            'createdAt' => 'تاریخ ایجاد نوشته',
            'updatedAt' => 'آخرین بروزرسانی',
            'isActive' => 'نمایش در سایت',
            'priority' => 'اولویت',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategoryRelations()
    {
        return $this->hasMany(PostCategoryRelation::className(), ['postId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'categoryId'])->viaTable('post_category_relation', ['postId' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
