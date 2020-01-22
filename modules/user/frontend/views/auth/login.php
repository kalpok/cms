<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'ورود';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-auth-login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <p class="login-box-msg">برای ورود، ایمیل و رمز عبور خود را وارد نمایید</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
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
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <?= Html::submitButton('ورود', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                        </div><!-- /.col -->
                    </div>
                <?php ActiveForm::end(); ?>

                <!-- <a href="#">I forgot my password</a><br> -->
            </div>
        </div>
    </div>
</div>
