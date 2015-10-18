<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'ورود';
?>
<div class="login-panel panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ورود به پنل مدیریت</h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <p>برای ورود، ایمیل و رمز عبور خود را وارد نمایید</p>
            <fieldset>
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
                
                <?= $form->field($model, 'rememberMe', ['template' => "{input}"])->checkbox() ?>
                
                <?= Html::submitButton('ورود', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
            </fieldset>
        <?php ActiveForm::end(); ?>
    </div>
</div>