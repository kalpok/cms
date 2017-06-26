<?php
use themes\admin360\widgets\Panel;
use yii\widgets\DetailView;
use themes\admin360\widgets\ActionButtons;
use modules\user\backend\models\ProfileField;

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'مدیریت پروفایل', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= ActionButtons::widget([
    'modelID' => $model->id,
    'buttons' => [
        'update' => ['label' => 'ویرایش'],
        'delete' => ['label' => 'حذف'],
        'create' => ['label' => 'فیلد جدید'],
        'index' => ['label' => 'مدیریت پروفایل'],
    ],
]); ?>
<?php Panel::begin([
    'title' => $model->label,
]) ?>
    <div class="user-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id:farsiNumber',
                'language',
                'label',
                'type',
                'priority',
                'createdAt:datetime',
                'updatedAt:datetime'
            ],
        ]) ?>
    </div>
<?php Panel::end() ?>
