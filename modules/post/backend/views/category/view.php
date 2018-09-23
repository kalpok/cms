<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

?>
<div class="post-category-view">
    <div class="row">
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'اطلاعات دسته',
                'showCloseButton' => true
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
