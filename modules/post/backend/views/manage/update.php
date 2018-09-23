<?php

use yii\helpers\Html;
use theme\widgets\ActionButtons;

$this->title = 'ویرایش نوشته';
$this->params['breadcrumbs'][] = ['label' => 'نوشته ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="post-update">
	<?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'create' => ['label' => 'نوشته‌ جدید'],
            'delete' => ['label' => 'حذف'],
            'index' => ['label' => 'نوشته ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
