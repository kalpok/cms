<?php
use yii\helpers\Html;
use themes\admin360\widgets\Panel;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use themes\admin360\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'برگه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'update' => ['label' => 'ویرایش'],
            'gallery' => [
                'label'=> $model->hasGallery() ? 'گالری' : 'ساخت گالری',
                'visibleFor' => [
                    'page.create',
                    'page.update',
                    'page.delete'
                ]
            ],
            'delete' => ['label' => 'حذف'],
            'create' => ['label' => 'برگه جدید'],
            'index' => ['label' => 'برگه ها']
        ],
    ]); ?>
    <p>
        <?php if (count($children) > 0): ?>
            <?php Alert::begin(['options' => ['class' => 'alert-warning'], 'closeButton' => false]); ?>
                <p>
                    <b>احتیاط کنید!</b> با حذف کردن این برگه تمامی برگه‌هایی که زیرمجموعه آن هستند نیز از سیستم حذف می شوند. در حال حاضر این
                    برگه
                    <strong>* <?php echo Yii::$app->i18n->translateNumber(count($children)) ?> *</strong>
                    زیر مجموعه دارد.
                </p>
            <?php Alert::end() ?>
        <?php endif ?>
    </p>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin([
                'title' => 'محتوای برگه',
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
                    'slug',
                    'createdAt:date',
                    'updatedAt:date',
                    'isActive:boolean',
                    [
                        'label' => "برگه پدر",
                        'visible' => !$model->isRoot(),
                        'value' => ($model->isRoot()) ?: Html::a(
                            $model->getParent()->title,
                            ['view', 'id' => $model->getParent()->id]
                        ),
                        'format' => 'raw'
                    ],
                ],
            ]) ?>
            <?php Panel::end() ?>
            <?php Panel::begin([
                'title' => 'زیرمجموعه ها',
            ]) ?>
                <?php if (!empty($children)): ?>
                    <ul class="children" style="list-style:none; font-size:115%">
                        <?php foreach ($children as $child): ?>
                            <li><?= $child->prefixedTitle ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php else: ?>
                    این برگه زیر مجموعه ای ندارد.
                <?php endif ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
