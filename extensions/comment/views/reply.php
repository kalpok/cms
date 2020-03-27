<?php

use yii\helpers\Html;
use theme\widgets\Button;
use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <div class="col-md-8">
        <div class="reply-comment-form">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'sliding-form']
            ]) ?>
                <div class="well">
                    <?= Html::encode($comment->content) ?>
                </div>
                <?= $form->field($comment, 'reply')->textarea() ?>
                <?= Html::submitButton(
                    '<i class="fa fa-save"></i> ذخیره',
                    [
                        'class' => 'btn btn-lg btn-success'
                    ]
                ) ?>
                <?= Button::widget([
                    'label' => 'انصراف',
                    'options' => [
                        'class' => 'btn-lg close-sliding-form-button'
                    ],
                    'type' => 'warning',
                    'icon' => 'undo'
                ]) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
