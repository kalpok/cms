<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش فیلد';
$this->params['breadcrumbs'][] = ['label' => 'مدیریت پروفایل', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="profile-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'delete' => ['label' => 'حذف'],
            'create' => ['label' => 'فیلد جدید'],
            'index' => ['label' => 'مدیریت پروفایل'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
