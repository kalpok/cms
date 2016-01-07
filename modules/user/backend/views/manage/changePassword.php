<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use modules\user\backend\models\User;
use themes\admin360\widgets\ActionButtons;
use modules\user\common\widgets\ShowPassword;

$this->title = 'تغییر رمز عبور';
$this->params['breadcrumbs'][] = ['label' => 'کاربران', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'تغییر رمز عبور';
?>
<?= ActionButtons::widget([
    'modelID' => $model->id,
    'buttons' => [
        'index' => ['label' => 'کاربران']
    ],
]); ?>
<?php Panel::begin(
    [
        'title' => 'تغییر کلمه عبور'
    ]
) ?>
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
                <?= $form->field($model, 'password')
                    ->widget(
                        ShowPassword::className(),
                        [
                            'options' => ['class'=>'form-control']
                        ]
                    )->label('کلمه عبور جدید')
                ?>
            </div>
            <div class="col-md-4">
                <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                    'class' => 'btn btn-lg btn-success'
                ])?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => ['view', 'id' => $model->id],
                    ])
                ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php Panel::end();
