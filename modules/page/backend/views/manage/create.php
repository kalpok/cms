<?php

use yii\helpers\Html;
use core\widgets\ActionButtons;

$this->title = 'ساخت صفحه جدید';
$this->params['breadcrumbs'][] = ['label' => 'صفحات استاتیک', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'مدیریت صفحات'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
