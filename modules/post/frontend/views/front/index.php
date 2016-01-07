<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel modules\post\frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'اخبار';
$this->params['breadcrumbs'][] = ['label'=>'اخبار', 'url'=>['/post/front/index']];
if (isset($category)) {
	$this->title .= ' - '.$category->title;
	$this->params['breadcrumbs'][] = $category->title;
}
?>
<div class="post-index">

    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_posts',
        'layout' => "{items}\n{pager}"
    ]); ?>

</div>
