<?php
namespace modules\post\frontend\widgets\categories;

use modules\post\frontend\models\Category;

class Categories extends \yii\base\Widget
{
    public $limit;
    public $orderBy = 'createdAt DESC';
    public $title = 'لیست دسته ها';
    public $view = 'default';
    public $icon;

    public function run()
    {
        $categories = Category::find()
            ->addOrderBy($this->orderBy)
            ->limit($this->limit)
            ->all();
        if (empty($categories)) {
            return;
        }
        return $this->render(
            $this->view,
            [
                'categories' => $categories,
            ]
        );
    }
}
