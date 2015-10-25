<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش صفحه : ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'صفحات استاتیک', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش صفحه '.  $model->title;
?>
<div class="page-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'مدیریت صفحات'],
            'create' => ['label' => 'صفحه جدید']
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
