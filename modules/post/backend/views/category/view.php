<?php

use theme\widgets\Panel;
use yii\widgets\DetailView;

?>

<div class="post-category-view">
    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin() ?>
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

<?php $this->registerJs('
    $(document).ready(function () {
        $(".modal-inner").trigger("pageReady");
    });
');
