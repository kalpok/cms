<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = 'لیست برگه‌ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Pages-index">
<?= ActionButtons::widget([
    'buttons' => [
        'create' => ['label' => 'برگه جدید'],
    ],
]); ?>
<?php Panel::begin([
    'title' => 'لیست برگه‌ها'
]) ?>
<?php Pjax::begin([
    'id' => 'page-gridviewpjax',
    'enablePushState' => false,
]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'core\grid\IDColumn'],
            ['class' => 'core\grid\LanguageColumn'],
            [
                'class' => 'core\grid\ThumbnailColumn',
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
                'format' => 'date',
                'filter' => false
            ],
            ['class' => 'core\grid\ActiveColumn'],
            [
             'class' => 'yii\grid\ActionColumn',
             'template' => '{view} {update}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
