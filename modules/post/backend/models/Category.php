<?php

namespace modules\post\backend\models;

use Yii;
use kalpok\behaviors\TimestampBehavior;
use kalpok\behaviors\SluggableBehavior;
use kalpok\validators\FarsiCharactersValidator;

class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;
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
            [['title'], 'required'],
            [['description'], 'string'],
            [['isActive'], 'integer'],
            [['title', 'language'], 'string', 'max' => 255],
            [['title', 'description'], FarsiCharactersValidator::className()]
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
            'description' => 'توضیحات',
            'language' => 'زبان',
            'slug' => 'Slug',
            'createdAt' => 'تاریخ ایجاد نوشته',
            'updatedAt' => 'آخرین بروزرسانی',
            'isActive' => 'نمایش در سایت',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'postId'])->viaTable('post_category_relation', ['categoryId' => 'id']);
    }
}
