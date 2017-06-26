<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use modules\user\backend\models\ProfileField;
use themes\admin360\widgets\ActionButtons;

$this->title = 'مدیریت پروفایل';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= ActionButtons::widget([
    'buttons' => [
        'create' => [
            'label' => 'فیلد جدید'
        ]
    ]
]) ?>
<?php Panel::begin([
    'title' => 'فیلدها'
]) ?>
    <?php Pjax::begin([
        'id' => 'profile-grid',
        'enablePushState' => false,
    ]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'core\grid\IDColumn'],
                'language',
                'label',
                [
                    'attribute' => 'type',
                    'filter' => ProfileField::typeLabels(),
                    'value' => function ($model) {
                        return $model->getTypeLabel();
                    },
                ],
                'priority',
                'createdAt:datetime',
                'updatedAt:datetime',
                [
                    'class' => 'core\grid\ActionColumn',
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
