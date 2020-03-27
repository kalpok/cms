<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\bootstrap\ActiveForm;
use core\widgets\editor\Editor;

?>

<?php Panel::begin(['title' => 'پاسخ به نظر']) ?>
    <div class="row">
        <div class="col-md-8">
            <div class="reply-comment-form">
                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'sliding-form']
                ]) ?>
                    <div class="well">
                        <?= $comment->content ?>
                    </div>
                    <?= $form->field($comment, 'reply')->widget(
                        Editor::class
                    ) ?>
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
<?php Panel::end() ?>
