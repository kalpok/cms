<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use modules\post\frontend\widgets\postslist\PostsList;
use modules\post\frontend\widgets\categories\Categories;

/* @var $this yii\web\View */
/* @var $searchModel modules\post\frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Posts';
$this->params['breadcrumbs'][] = ['label'=>'Posts', 'url'=>['/post/front/index']];
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

<?php $this->beginBlock('sidebar') ?>
	<?= PostsList::widget(); ?>
	<?= Categories::widget(); ?>
<?php $this->endBlock() ?>
