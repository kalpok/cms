<?php

use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $model modules\post\backend\models\Post */

$this->title = 'افزودن نوشته';
$this->params['breadcrumbs'][] = ['label' => 'همه نوشته‌ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-manage-create">
	<?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'همه نوشته‌ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
