<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'نوشته ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-manage-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'update' => ['label' => 'ویرایش'],
            'gallery' => [
                'label'=> $model->hasGallery() ? 'گالری' : 'ساخت گالری',
                'visibleFor' => [
                    'post.create',
                    'post.update',
                    'post.delete'
                ]
            ],
            'delete' => ['label' => 'حذف'],
            'create' => ['label' => 'نوشته‌ جدید'],
            'index' => ['label' => 'نوشته ها'],
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin([
                'title' => 'محتوای نوشته',
            ]) ?>
                <div class="well">
                    <?= $model->content ?>
                </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-5">
            <?php if (!empty($model->getFile('image'))): ?>
                <?php Panel::begin([
                        'title' => 'تصویر شاخص'
                    ]);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <?=
                            Html::img(
                                $model->getFile('image')->getUrl('view-thumb')
                            );
                        ?>
                    </div>
                </div>
                <?php Panel::end() ?>
            <?php endif ?>
            <?php Panel::begin([
                'title' => 'سایر اطلاعات',
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id:farsiNumber',
                    [
                        'attribute' => 'language',
                        'visible' => Yii::$app->i18n->isMultiLanguage(),
                        'format' => 'language'
                    ],
                    'title',
                    'summary',
                    'slug',
                    'categories',
                    'createdAt:date',
                    'updatedAt:date',
                    'isActive:boolean',
                    'priority:farsiNumber'
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
