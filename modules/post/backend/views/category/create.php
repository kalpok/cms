<?php

use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $model modules\post\backend\models\Category */

$this->title = 'افزودن دسته';
$this->params['breadcrumbs'][] = ['label' => 'نوشته ها', 'url' => ['/post/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'دسته ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-create">
	<?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'دسته ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
