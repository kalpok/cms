<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = 'دسته های نوشته';
$this->params['breadcrumbs'][] = ['label' => 'نوشته ها', 'url' => ['/post/manage/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="post-category-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'دسته جدید',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'post-category-gridviewpjax',
                    'data-modalheader' => 'دسته جدید',
                    'data-modalfooterbtns' => 'true'
                ]
            ],
            'pages' => [
                'label' => 'نوشته ها',
                'url' => ['manage/index'],
                'type' => 'warning',
                'icon' => 'list'
            ]
        ]
    ]) ?>
    <?php Panel::begin(['title' => Html::encode($this->title)]) ?>
        <?php Pjax::begin([
            'id' => 'post-category-gridviewpjax',
            'enablePushState' => false
        ]) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'core\grid\LanguageColumn'],
                    'title',
                    [
                        'attribute' => 'createdAt',
                        'format' =>'date',
                        'filter' =>false
                    ],
                    ['class' => 'core\grid\ActiveColumn'],
                    [
                        'class' => 'core\grid\AjaxActionColumn',
                        'viewModalHeader' => 'اطلاعات دسته',
                        'updateModalHeader' => 'ویرایش اطلاعات دسته'
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
