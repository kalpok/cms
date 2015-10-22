<?php
use core\widgets\Panel;
use yii\widgets\DetailView;
use core\widgets\ActionButtons;
use core\modules\user\backend\models\User;

$this->title = $model->email;
?>
<?= ActionButtons::widget([
    'modelID' => $model->id,
    'buttons' => [
        'index' => ['label' => 'مدیریت کاربران'],
        'create' => ['label' => 'کاربر جدید'],
        'update' => ['label' => 'ویرایش کاربر'],
        'change-password' => [
            'icon' => 'key',
            'type' => 'warning',
            'label' => 'تغییر رمز عبور',
            'url' => ['change-password', 'id' => $model->id]
        ],
        'delete' => ['label' => 'حذف کاربر']
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
                'email',
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
