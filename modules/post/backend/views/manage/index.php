<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use modules\post\backend\models\Category;
use theme\widgets\ActionButtons;

$this->title = 'لیست نوشته ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-manage-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => ['label' => 'نوشته جدید'],
            'categoriesIndex' => ['label' => 'دسته ها'],
        ],
    ]); ?>
    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'post-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'core\grid\IDColumn'],
                    ['class' => 'core\grid\LanguageColumn'],
                    'title',
                    [
                        'attribute' => 'categories',
                        'filter' => ArrayHelper::map(
                            Category::findAll(['isActive' => Category::STATUS_ACTIVE]),
                            'title',
                            'title'
                        ),
                        'value' => function ($model) {
                            return $model->categories;
                        },
                    ],
                    [
                        'attribute' => 'createdAt',
                        'format' =>'date',
                        'filter' =>false
                    ],
                    ['class' => 'core\grid\ActiveColumn'],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
