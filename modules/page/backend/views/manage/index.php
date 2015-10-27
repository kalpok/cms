<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = 'صفحات استاتیک';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Pages-index">
<?= ActionButtons::widget([
    'buttons' => [
        'create' => ['label' => 'صفحه جدید'],
    ],
]); ?>
<?php Panel::begin([
    'title' => 'لیست صفحات استاتیک'
]) ?>
<?php Pjax::begin([
    'id' => 'page-gridviewpjax',
    'enablePushState' => false,
]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kalpok\grid\IDColumn'],
            [
                'class' => 'kalpok\grid\ThumbnailColumn',
                'group' => 'image',
                'label' => 'تصویر شاخص'
            ],
            [
                'attribute' => 'title',
                'value' => function ($model) {
                    return $model->prefixedTitle;
                },
            ],
            [
                'attribute' => 'createdAt',
                'format' =>'date',
                'filter' =>false
            ],
            ['class' => 'kalpok\grid\ActiveColumn'],
            [
             'class' => 'yii\grid\ActionColumn',
             'template' => '{view} {update}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
