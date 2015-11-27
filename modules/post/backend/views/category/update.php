<?php

use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $model modules\post\backend\models\Category */

$this->title = 'ویرایش دسته';
$this->params['breadcrumbs'][] = ['label' => 'نوشته‌ها', 'url' => ['/post/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'دسته‌ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="post-category-update">
	<?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'create' => ['label' => 'افزودن دسته'],
            'delete' => ['label' => 'حذف'],
            'index' => ['label' => 'دسته‌ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
