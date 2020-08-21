<?php

use theme\widgets\Panel;
use yii\widgets\DetailView;
use extensions\comment\models\Comment;

?>

<div class="post-category-view">
    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin() ?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'content:html',
                        'inserterName',
                        'inserterEmail',
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

<?php $this->registerJs('
    $(document).ready(function () {
        $(".modal-inner").trigger("pageReady");
    });
');
