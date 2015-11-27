<?php

use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $model modules\post\backend\models\Post */

$this->title = 'ویرایش نوشته';
$this->params['breadcrumbs'][] = ['label' => 'همه نوشته‌ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="post-update">
	<?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'create' => ['label' => 'افزودن نوشته‌'],
            'delete' => ['label' => 'حذف'],
            'index' => ['label' => 'همه نوشته‌ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
