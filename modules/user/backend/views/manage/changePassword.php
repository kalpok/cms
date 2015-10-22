<?php
use yii\helpers\Html;
use core\widgets\Panel;
use core\widgets\Button;
use yii\bootstrap\ActiveForm;
use core\widgets\ActionButtons;
use modules\user\backend\models\User;
use modules\user\common\widgets\ShowPassword;
?>
<?= ActionButtons::widget([
    'modelID' => $model->id,
    'buttons' => [
        'index' => ['label' => 'مدیریت کاربران'],
        'view' => [
            'url' => ['view', 'id' => $model->id],
            'type' => 'success',
            'icon' => 'eye',
            'label' => 'مشاهده اطلاعات کاربر'
        ],
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
