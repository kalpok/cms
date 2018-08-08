<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

?>
<div class="post-category-view">
    <div class="row">
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'اطلاعات دسته',
                'tools' => Html::a(
                    '<span class="glyphicon glyphicon-remove"></span>',
                    null,
                    [
                        'class' => 'close-sliding-form-toggle'
                    ]
                )
            ]) ?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id:farsiNumber',
                        'title',
                        'description',
                        [
                            'attribute' => 'language',
                            'visible' => Yii::$app->i18n->isMultiLanguage(),
                            'format' => 'language'
                        ],
                        'slug',
                        'createdAt:date',
                        'updatedAt:date',
                        'isActive:boolean',
                    ],
                ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
