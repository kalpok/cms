<?php
use yii\helpers\Html;
use core\widgets\Panel;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use core\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'صفحات استاتیک', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'index' => ['label' => 'مدیریت صفحات'],
            'create' => ['label' => 'صفحه جدید'],
            'update' => ['label' => 'ویرایش صفحه'],
            'delete' => ['label' => 'حذف صفحه']
        ],
    ]); ?>
    <p>
        <?php if (count($children) > 0): ?>
            <?php Alert::begin(['options' => ['class' => 'alert-warning'], 'closeButton' => false]); ?>
                <p>
                    <b>احتیاط کنید!</b> با حذف کردن این صفحه تمامی صفحاتی که زیرمجموعه آن هستند نیز از سیستم حذف می شوند. در حال حاضر این صفحه
                    <strong>* <?php echo Yii::$app->i18n->translateNumber(count($children)) ?> *</strong>
                    زیر مجموعه دارد.
                </p>
            <?php Alert::end() ?>
        <?php endif ?>
    </p>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin([
                'title' => 'محتوای صفحه',
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
                    'title',
                    'createdAt:date',
                    'updatedAt:date',
                    'isActive:boolean',
                    [
                        'label' => "صفحه پدر",
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
                    این صفحه زیر مجموعه ای ندارد.
                <?php endif ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
