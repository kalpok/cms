<?php

use theme\widgets\Panel;
use yii\bootstrap\ActiveForm;
use core\widgets\editor\Editor;

?>

<?php Panel::begin() ?>
    <div class="row">
        <div class="col-md-12">
            <div class="reply-comment-form">
                <?php $form = ActiveForm::begin() ?>
                    <div class="well">
                        <?= $comment->content ?>
                    </div>
                    <?= $form->field($comment, 'reply')->widget(
                        Editor::class
                    ) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
<?php Panel::end() ?>

<?php $this->registerJs('
    $(document).ready(function () {
        $(".modal-inner").trigger("pageReady");
    });
');
