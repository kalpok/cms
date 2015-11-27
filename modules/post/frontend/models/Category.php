<?php

namespace modules\post\frontend\models;

use Yii;

/**
 * This is the model class for table "post_category".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $language
 * @property string $slug
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property integer $isActive
 *
 * @property PostCategoryRelation[] $postCategoryRelations
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_category';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'postId'])->viaTable('post_category_relation', ['categoryId' => 'id']);
    }
}
