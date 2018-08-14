<?php

namespace modules\post\backend\models;

use core\behaviors\PreventDeleteBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    public static function tableName()
    {
        return 'post_category';
    }

    public function behaviors()
    {
        return [
            'core\behaviors\TimestampBehavior',
            'sluggable' => [
                'class' => 'core\behaviors\SluggableBehavior',
                'attribute' => 'title',
            ],
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'getPosts',
                        'relationName' => 'نوشته'
                    ]
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['isActive'], 'integer'],
            [['title', 'language'], 'string', 'max' => 255],
            [['title', 'description'], FarsiCharactersValidator::className()]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'language' => 'زبان',
            'slug' => 'Slug',
            'createdAt' => 'تاریخ ایجاد',
            'updatedAt' => 'آخرین بروزرسانی',
            'isActive' => 'نمایش در سایت',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['id' => 'postId'])
            ->viaTable('post_category_relation', ['categoryId' => 'id']);
    }
}
