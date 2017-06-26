<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'فیلد جدید';
$this->params['breadcrumbs'][] = ['label' => 'مدیریت پروفایل', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'مدیریت پروفایل']
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
