<?php
use yii\helpers\Html;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use yii\bootstrap\ActiveForm;
use modules\user\backend\models\User;
use modules\user\common\widgets\ShowPassword;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="user-form">
    <?php
    $form = ActiveForm::begin(
        [
            'enableClientValidation' => true,
            'id' => 'user-form',
        ]
    );
    ?>
    <div class="row">
        <div class="col-md-8">
        <?php Panel::begin([
            'title' => 'اطلاعات کاربر',
            'options' => ['class' => 'panel-primary'],
        ]) ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(
                    ['class' => 'form-control input-large']
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'surname')->textInput(
                    ['class' => 'form-control input-large']
                ) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(
                    ['class' => 'form-control input-large', 'style' => 'direction:ltr']
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'phone')->textInput(
                    ['class' => 'form-control input-large', 'style' => 'direction:ltr']
                ) ?>
            </div>
        </div>
            <?php if ($model->isNewRecord) : ?>
                <?= $form->field($model, 'password')
                    ->widget(
                        ShowPassword::className(),
                        ['options' => ['class'=>'form-control']]
                    )
                ?>
            <?php endif ?>
            <?=
                $form->field($model, 'type', ['template' => "{input}"])->hiddenInput(['value'=>User::TYPE_SUPERUSER]);
                /*$form->field($model, 'type')
                ->dropDownList(
                    [
                        User::TYPE_OPERATOR => 'اپراتور',
                        User::TYPE_EDITOR => 'سردبیر',
                        User::TYPE_SUPERUSER => 'مدیر سیستم'
                    ],
                    ['class' => 'form-control input-small']
                )*/
            ?>
            <?= $form->field($model, 'status')
                ->dropDownList(
                    User::statusLabels(),
                    ['class' => 'form-control input-small']
                )
            ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                    'class' => 'btn btn-lg btn-success'
                ])?>

                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                ?>
            </div>
        <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
