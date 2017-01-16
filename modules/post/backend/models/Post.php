<?php

namespace modules\post\backend\models;

use Yii;
use kalpok\behaviors\SluggableBehavior;
use kalpok\behaviors\TimestampBehavior;
use kalpok\file\behaviors\FileBehavior;
use kalpok\behaviors\CategoriesBehavior;
use modules\post\backend\models\PostQuery;
use extensions\i18n\validators\FarsiCharactersValidator;

class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        $module = \modules\post\backend\Module::getInstance();
        return [
            'gallery' => '\extensions\gallery\behaviors\GalleryBehavior',
            TimestampBehavior::className(),
            CategoriesBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => ($module && $module->editableSlug) ? 'slug' : 'title',
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
            [['title', 'content', 'categories', 'slug'], 'required'],
            [['summary', 'content'], 'string'],
            [['isActive', 'priority'], 'integer'],
            [['title', 'language'], 'string', 'max' => 255],
            [['title', 'content', 'summary'], FarsiCharactersValidator::className()]
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
            'categories' => 'دسته ها',
            'createdAt' => 'تاریخ ایجاد نوشته',
            'updatedAt' => 'آخرین بروزرسانی',
            'isActive' => 'نمایش در سایت',
            'priority' => 'اولویت',
        ];
    }

    public static function find()
    {
        $query = new PostQuery(get_called_class());
        return $query;
    }

    public function getCats()
    {
        return $this->hasMany(Category::className(), ['id' => 'categoryId'])->viaTable('post_category_relation', ['postId' => 'id']);
    }
}
