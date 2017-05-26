<?php
namespace modules\post\frontend\widgets\postslist;

use yii;
use modules\post\frontend\models\Post;
use modules\post\frontend\models\Category;

class PostsList extends \yii\base\Widget
{
    public $title = 'لیست نوشته ها';
    public $view = 'default';
    public $categoryId;
    public $limit = 5;
    public $orderBy = 'priority DESC, createdAt DESC';

    private $category;

    public function run()
    {
        $query = Post::find()
            ->addOrderBy($this->orderBy)
            ->limit($this->limit);
        if (isset($this->categoryId)) {
            $this->category = Category::find()
                ->andWhere(['id' => $this->categoryId])->one();
            $query = $query->joinWith('categories')
                ->andWhere('categoryId = :catId', ['catId' => $this->categoryId]);
        }
        return $this->render(
            'default',
            [
                'posts' => $query->all(),
                'category' => $this->category
            ]
        );
    }
}
