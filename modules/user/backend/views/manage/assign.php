<?php
use yii\helpers\Html;
use yii\bootstrap\Collapse;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;

$this->title = 'اعطای دسترسی به کاربر';
$this->params['breadcrumbs'][] = $this->title;
$accordion = [];

foreach ($modules as $moduleId => $title) {
    $accordion[$moduleId]['label'] = $title;
    $accordion[$moduleId]['content'] = Html::checkboxList(
        "permisions",
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
        <?php Box::begin([
            'title' => 'اعطای دسترسی',
            'options' => ['class' => 'box-solid box-primary'],
        ]) ?>
            <?= Html::beginForm(); ?>
            <?= Collapse::widget(['items' => $accordion]);?>
            <?= Html::submitButton(
                '<i class="fa fa-save"></i> ذخیره',
                ['class' => 'btn btn-lg btn-flat margin bg-green']
            )?>
            <?= Button::widget(
                [
                    'title' =>'انصراف',
                    'options' => ['class' => 'btn-lg btn-flat margin'],
                    'color' => 'orange',
                    'icon' => 'undo',
                    'url'=>array('index')
                ]
            )
            ?>
            <?= Html::endForm(); ?>
        <?php Box::end() ?>
    </div>
</div>
