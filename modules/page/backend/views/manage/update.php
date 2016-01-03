<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش برگه : ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'لیست برگه‌ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش برگه '.  $model->title;
?>
<div class="page-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'مدیریت برگه'],
            'create' => ['label' => 'برگه جدید']
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
