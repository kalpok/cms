<?php

use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'ساخت برگه جدید';
$this->params['breadcrumbs'][] = ['label' => 'لیست برگه‌ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'مدیریت برگه‌ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
