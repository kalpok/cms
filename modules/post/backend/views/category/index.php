<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = 'دسته های نوشته';
$this->params['breadcrumbs'][] = ['label' => 'نوشته ها', 'url' => ['/post/manage/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'دسته جدید',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'post-category-gridviewpjax'
                ]
            ],
            'pages' => [
                'label' => 'نوشته ها',
                'url' => ['manage/index'],
                'type' => 'warning',
                'icon' => 'list'
            ]
        ]
    ]) ?>

    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'post-category-gridviewpjax',
            'enablePushState' => false
        ]) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'core\grid\LanguageColumn'],
                    'title',
                    [
                        'attribute' => 'createdAt',
                        'format' =>'date',
                        'filter' =>false
                    ],
                    ['class' => 'core\grid\ActiveColumn'],
                    ['class' => 'core\grid\AjaxActionColumn']
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>

</div>
