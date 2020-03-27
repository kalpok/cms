<?php

use theme\widgets\Panel;
use yii\widgets\DetailView;
use modules\user\backend\models\User;
use extensions\comment\models\Comment;

?>

<div class="post-category-view">
    <div class="row">
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'اطلاعات نظر',
                'showCloseButton' => true
            ]) ?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'content:html',
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
                        'inserterIp',
                        'insertedAt:datetime',
                        'reply:html',
                        'repliedAt:datetime',
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return Comment::getStatusLabels()[$model->status];
                            }
                        ]
                    ]
                ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
