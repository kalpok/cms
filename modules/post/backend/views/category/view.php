<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'نوشته ها', 'url' => ['/post/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'دسته ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'create' => ['label' => 'دسته جدید'],
            'update' => ['label' => 'ویرایش'],
            'delete' => ['label' => 'حذف'],
            'index' => ['label' => 'دسته ها'],
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'اطلاعات دسته',
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
