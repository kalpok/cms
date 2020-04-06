<?php

namespace modules\post\backend\models;

use modules\post\backend\models\PostQuery;
use extensions\file\behaviors\FileBehavior;
use extensions\tag\behaviors\TaggableBehavior;
use extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post}}';
    }

    public function behaviors()
    {
        $module = \modules\post\backend\Module::getInstance();
        return [
            'core\behaviors\TimestampBehavior',
            'core\behaviors\CategoriesBehavior',
            'gallery' => '\extensions\gallery\behaviors\GalleryBehavior',
            'sluggable' => [
                'class' => 'core\behaviors\SluggableBehavior',
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
            ],
            [
                'class' => TaggableBehavior::class,
                'moduleId' => 'post'
            ],
            'comment' => [
                'class' => CommentBehavior::class,
                'moduleId' => 'post'
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title', 'content', 'categories', 'slug'], 'required'],
            [['summary', 'content'], 'string'],
            [['isActive', 'priority'], 'integer'],
            [['title', 'language'], 'string', 'max' => 255],
            [['title', 'content', 'summary'], FarsiCharactersValidator::className()],
            ['tags', 'safe']
        ];
    }

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
            'tags' => 'برچسب ها'
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
