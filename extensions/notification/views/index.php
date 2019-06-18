<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use core\widgets\select2\Select2;
use extensions\notification\models\Notification;

$this->title = 'اعلانات';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="notification-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin() ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn'
                    ],
                    [
                        'attribute' => 'read',
                        'label' => false,
                        'format' => 'raw',
                        'value' => function ($model) {
                            if ($model->read) {
                                return '<i style="color:green" class="fa fa-envelope-open-o"></i>';
                            } else {
                                return '<i style="color:red" class="fa fa-envelope-o"></i>';
                            }
                        }
                    ],
                    'title',
                    [
                        'attribute' => 'category',
                        'headerOptions' => ['style' => 'width:150px'],
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'category',
                            'data' => array_combine(
                                Notification::getCategories(),
                                Notification::getCategories()
                            ),
                            'options' => [
                                'placeholder' => 'دسته'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ])
                    ],
                    'createdAt:dateTime',
                    [
                        'class' => 'core\grid\ActionColumn',
                        'template' => '{link}',
                        'buttons' => [
                            'link' => function ($url, $model, $key) {
                                return Html::a(
                                    '<i class="fa fa-external-link"></i>',
                                    ['view', 'id' => $model->id],
                                    [
                                        'title' => 'مشاهده'
                                    ]
                                );
                            }
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
