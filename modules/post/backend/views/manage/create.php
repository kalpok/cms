<?php

use yii\helpers\Html;
use theme\widgets\ActionButtons;

$this->title = 'نوشته جدید';
$this->params['breadcrumbs'][] = ['label' => 'نوشته ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-manage-create">
	<?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'نوشته ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
