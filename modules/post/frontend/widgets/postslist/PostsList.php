<?php
namespace modules\post\frontend\widgets\postslist;

use yii;
use modules\post\frontend\models\Post;
use modules\post\frontend\models\Category;

class PostsList extends \yii\base\Widget
{
    public $categoryId;
    public $limit = 5;
    public $orderBy = 'priority DESC, createdAt DESC';
    public $title = 'لیست نوشته ها';
    public $view = 'default';
    public $icon;

    private $category;

    public function run()
    {
        $query = Post::find()->addOrderBy($this->orderBy)->limit($this->limit);
        if (isset($this->categoryId)) {
            $this->category =
                Category::find()->andWhere(['id' => $this->categoryId])->one();
            $query->joinWith('categories')->andWhere(
                'categoryId = :catId', ['catId' => $this->categoryId]
            );
        }
        return $this->render(
            $this->view,
            [
                'posts' => $query->all(),
                'category' => $this->category
            ]
        );
    }
}
