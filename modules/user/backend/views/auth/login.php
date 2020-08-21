<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'ورود';

?>

<body class="login-page">
    <div class="login-box">
        <div class="login-box-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <p>لطفا برای ورود اطلاعات زیر را تکمیل کنید.</p>
                <?= $form->errorSummary($model, ['class' => 'text-danger']) ?>
                <?= $form->field(
                    $model,
                    'username',
                    [
                        'template' => "{input}\n<span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span>\n{hint}\n{error}",
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputOptions' => ['placeholder' => "پست الکترونیکی", 'class' => "form-control"]
                    ]
                ) ?>
                <?= $form->field(
                    $model,
                    'password',
                    [
                        'template' => "{input}\n<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>\n{hint}\n{error}",
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputOptions' => ['placeholder' => "رمز عبور", 'class' => "form-control"]
                    ]
                )->passwordInput() ?>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <?= $form->field($model, 'rememberMe', ['template' => "{input}"])->checkbox() ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <?= Html::submitButton('ورود', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


