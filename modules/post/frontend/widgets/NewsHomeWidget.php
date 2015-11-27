<?php
namespace modules\post\frontend\widgets;

use yii;
use yii\base\Widget;
use modules\post\frontend\models\Post;

class NewsHomeWidget extends Widget
{
    public $limit = 10;  
    public function run()
    {
        $posts = Post::find()
            ->addOrderBy('priority DESC')
            ->addOrderBy('createdAt DESC')
            ->limit($this->limit)
            ->all();
        if (!empty($posts)) {
            return $this->render(
                'homeview',
                [
                    'posts'=>$posts
                ]
            );
        }
        return;
    }
}
