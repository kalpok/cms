<?php

use yii\helpers\Html;
use yii\bootstrap\Collapse;
use theme\widgets\Panel;
use theme\widgets\Button;

$this->title = 'اعطای دسترسی به کاربر';
$this->params['breadcrumbs'][] = ['label' => 'مدیریت کاربران', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

$accordion = [];
foreach ($modules as $moduleId => $moduleTitle) {
    $accordion[$moduleId]['label'] = $moduleTitle;
    $accordion[$moduleId]['content'] = Html::checkboxList(
        "permissions",
        $userPermissions,
        $allPermissions[$moduleId],
        [
            'itemOptions' => [
                'labelOptions' => [
                    'class' => 'checkbox-inline'
                ]
            ]
        ]
    );
    $accordion[$moduleId]['contentOptions'] = ['class' => 'in'];
}
?>

<div class="row">
    <div class="col-sm-12">
        <?php Panel::begin([
            'title' => 'اعطای دسترسی'
        ]) ?>
            <?= Html::beginForm() ?>
                <?= Html::hiddenInput('assignPermissions', true) ?>
                <?= Collapse::widget(['items' => $accordion]) ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                    'class' => 'btn btn-lg btn-success'
                ]) ?>
                <?= Button::widget(
                    [
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => ['index']
                    ]
                ) ?>
            <?= Html::endForm() ?>
        <?php Panel::end() ?>
    </div>
</div>
