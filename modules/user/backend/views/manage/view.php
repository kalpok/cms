<?php
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use modules\user\backend\models\User;

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'کاربران', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= ActionButtons::widget([
    'modelID' => $model->id,
    'buttons' => [
        'update' => ['label' => 'ویرایش'],
        'change-password' => [
            'icon' => 'key',
            'type' => 'warning',
            'label' => 'تغییر رمز عبور',
            'url' => ['change-password', 'id' => $model->id]
        ],
        'delete' => ['label' => 'حذف'],
        'create' => ['label' => 'کاربر جدید'],
        'index' => ['label' => 'کاربران'],
    ],
]); ?>
<?php Panel::begin([
    'title' => $model->email,
]) ?>
    <div class="user-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id:farsiNumber',
                'name',
                'surname',
                'email',
                'phone',
                [
                    'attribute' => 'status',
                    'value' => $model->getStatusLabel(),
                ],
                'createdAt:datetime',
                'lastLoggedInAt:datetime',
                [
                    'attribute' => 'type',
                    'value' => $model->gettypeLabel(),
                ],
            ],
        ]) ?>
    </div>
<?php Panel::end() ?>
