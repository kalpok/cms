<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use core\widgets\Panel;
use core\widgets\ActionButtons;
use core\modules\user\backend\models\User;

$this->title = 'مدیریت کاربران';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= ActionButtons::widget([
    'buttons' => [
        'create' => [
            'label' => 'کاربر جدید'
        ]
    ]
]) ?>
<?php Panel::begin([
    'title' => 'لیست کاربران'
]) ?>
    <?php Pjax::begin([
        'id' => 'user-grid',
        'enablePushState' => false,
    ]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'core\grid\IDColumn'],
                'email',
                [
                    'attribute' => 'type',
                    'filter' => User::typeLabels(),
                    'value' => function ($model) {
                        return $model->getTypeLabel();
                    },
                ],
                'lastLoggedInAt:datetime',
                [
                    'attribute' => 'status',
                    'filter' => User::statusLabels(),
                    'value' => function ($model) {
                        return $model->getStatusLabel();
                    },
                ],
                [
                    'class' => 'core\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {assign}
                        {change-password}',
                    'buttons' => [
                        'assign' => function ($url, $model, $key) {
                            if ($model->type != User::TYPE_SUPERUSER) {
                                return Html::a(
                                    '<span class="fa fa-lock"></span>',
                                    $url,
                                    ['title' => 'اعطای دسترسی', 'data-pjax' => 0]
                                );
                            }
                        },
                        'change-password' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="fa fa-key"></span>',
                                    $url,
                                    ['title' => 'تغییر رمز عبور', 'data-pjax' =>0]
                                );
                        },
                    ]
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
