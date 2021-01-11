<?php

use yii\helpers\Html;
use core\helpers\Utility;
use yii\bootstrap\ActiveForm;
use theme\widgets\Panel;
use extensions\file\widgets\singleupload\SingleImageUpload;

?>

<div class="gallery-form">
    <?php Panel::begin() ?>
        <?php $form = ActiveForm::begin() ?>
            <div class="row">
                <div class="col-md-6">
                    <?= Html::activeHiddenInput($model, 'galleryId') ?>
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => 255,
                        'class'=>'form-control input-xlarge'
                    ]) ?>
                    <?= $form->field($model, 'link')->textInput([
                        'maxlength' => 512,
                        'class' => 'form-control input-xlarge',
                        'style' => 'direction:ltr'
                    ]) ?>
                    <?= $form->field($model, 'description')->textarea([
                        'rows' => 6,
                        'class'=>'form-control input-xlarge'
                    ]) ?>
                    <?= $form->field($model, 'order')->dropDownList(
                            Utility::listNumbers(1, 20),
                            ['class' => 'form-control input-medium']
                    ) ?>
                </div>
                <div class="col-md-6">
                    <?= SingleImageUpload::widget([
                        'model' => $model,
                        'group' => 'gallery_image',
                        'folderName' => 'gallery',
                        'label' => ''
                    ]) ?>
                </div>
            </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>

<?php $this->registerJs('
    $(document).ready(function () {
        $(".modal-inner").trigger("pageReady");
    });
');
