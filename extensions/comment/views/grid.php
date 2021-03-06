<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use core\helpers\Utility;
use extensions\comment\models\Comment;

?>

<a class="ajaxcreate" data-gridpjaxid="comment-index-gridviewpjax"></a>
<div class="comment-index">
    <?php Pjax::begin([
        'id' => 'comment-index-gridviewpjax',
        'enablePushState' => false
    ]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'style' => 'overflow: auto; word-wrap: break-word'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'شناسه ' . $ownerPersianName,
                'attribute' => 'ownerId'
            ],
            [
                'label' => $ownerPersianName,
                'format' => 'raw',
                'value' => function ($model) use ($ownerClassName) {
                    return Html::a(
                        $ownerClassName::findOne($model->ownerId)->title,
                        ['view', 'id' => $model->ownerId],
                        [
                            'target' => '_blank',
                            'data-pjax' => '0'
                        ]
                    );
                }
            ],
            [
                'attribute' => 'content',
                'value' => function ($model) {
                    return Utility::makeStringShorten($model->content);
                },
                'format' => 'raw',
            ],
            'inserterName',
            'inserterEmail',
            'insertedAt:datetime',
            'reply:html',
            [
                'attribute' => 'status',
                'filter' => Comment::getStatusLabels(),
                'value' => function ($model) {
                    return Comment::getStatusLabels()[$model->status];
                }
            ],
            [
                'class' => 'core\grid\AjaxActionColumn',
                'template' => '{view} {reply} {accept} {delete} {reject}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            ['/comment/view', 'id' => $model->id],
                            [
                                'title' => 'مشاهده اطلاعات نظر',
                                'class' => 'ajaxview',
                                'data-gridpjaxid' => 'comment-index-gridviewpjax'
                            ]
                        );
                    },
                    'reply' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="fa fa-reply"></span>',
                            ['/comment/reply', 'id' => $model->id],
                            [
                                'title' => 'پاسخ به نظر',
                                'class' => 'ajaxupdate',
                                'data-gridpjaxid' => 'comment-index-gridviewpjax'
                            ]
                        );
                    },
                    'accept' => function ($url, $model, $key) {
                        if ($model->status != Comment::STATUS_ACCEPTED) {
                            return Html::a(
                                '<span class="fa fa-check"></span>',
                                ['/comment/accept', 'id' => $model->id],
                                [
                                    'title' => 'تایید نظر',
                                    'class' => 'ajaxrequest'
                                ]
                            );
                        }
                    },
                    'reject' => function ($url, $model, $key) {
                        if ($model->status != Comment::STATUS_REJECTED) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-remove"></span>',
                                ['/comment/reject', 'id' => $model->id],
                                [
                                    'title' => 'عدم تایید نظر',
                                    'class' => 'ajaxrequest'
                                ]
                            );
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            ['/comment/delete', 'id' => $model->id],
                            [
                                'title' => 'حذف نظر',
                                'class' => 'ajaxdelete',
                                'data-gridpjaxid' => 'comment-index-gridviewpjax'
                            ]
                        );
                    }
                ]
            ]
        ]
    ]) ?>
    <?php Pjax::end() ?>
</div>
