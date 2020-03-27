<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use core\helpers\Utility;
use modules\user\common\models\User;
use extensions\comment\models\Comment;

?>

<div class="comment-index">
    <div class="sliding-form-wrapper"></div>
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
                        }
                    ],
                    'inserterName',
                    'inserterEmail',
                    [
                        'label' => 'موبایل درج کننده',
                        'attribute' => 'inserterMobile',
                        'format' => 'farsiNumber',
                        'value' => function ($model) {
                            if ($model->insertedBy) {
                                return User::findOne($model->insertedBy)->mobile;
                            }
                        }
                    ],
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
                        'template' => '{reply} {accept} {delete} {reject}',
                        'buttons' => [
                            'reply' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="fa fa-reply"></span>',
                                    ['/comment/reply', 'id' => $model->id],
                                    [
                                        'title' => 'پاسخ به نظر',
                                        'class' => 'ajaxupdate',
                                        'data-pjaxid' => 'comment-index-gridviewpjax'
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
                            }
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    </div>
</div>
