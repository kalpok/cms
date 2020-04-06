<?php

use yii\helpers\Html;
use theme\widgets\ActionButtons;

$this->title = 'برگه جدید';
$this->params['breadcrumbs'][] = ['label' => 'برگه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'برگه ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
