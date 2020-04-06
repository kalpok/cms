<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use modules\user\common\widgets\ShowPassword;
 ?>
<div class="user-form">
    <?php
    $form = ActiveForm::begin(
        [
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'id' => 'user-form',
            'action' => ['/user/front/register']
        ]
    );
    ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'email')
                ->textInput(['class' => 'form-control input-medium', 'style' => 'direction:ltr']) ?>
            <?= $form->field($model, 'password')
                ->widget(
                    ShowPassword::className(),
                    ['options' => ['class'=>'form-control']]
                )
            ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                    'class' => 'btn btn-lg btn-success'
                ])?>

            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>