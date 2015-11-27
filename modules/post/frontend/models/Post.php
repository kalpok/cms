<?php

namespace modules\post\frontend\models;

use Yii;
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
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'categoryId'])->viaTable('post_category_relation', ['postId' => 'id']);
    }
}
