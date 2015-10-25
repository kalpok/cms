<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش کاربر' . '" ' .$model->email. '" ';
$this->params['breadcrumbs'][] = ['label' => 'کاربران', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="user-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'مدیریت کاربران'],
            'create' => ['label' => 'کاربر جدید'],
            'change-password' => [
                'icon' => 'key',
                'type' => 'warning',
                'label' => 'تغییر رمز عبور',
                'url' => ['change-password', 'id' => $model->id]
            ],
            'delete' => ['label' => 'حذف کاربر']
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
