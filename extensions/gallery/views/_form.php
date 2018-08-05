<?php
use yii\helpers\Html;
use core\helpers\Utility;
use yii\bootstrap\ActiveForm;
use themes\admin360\widgets\Panel;
use extensions\file\widgets\singleupload\SingleImageUpload;
?>
<?php Panel::begin([
    'title' => ($model->isNewRecord) ? 'افزودن عکس جدید' : 'ویرایش عکس',
]) ?>
    <div class="gallery-form">
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => true,
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'sliding-form'
            ]
        ]) ?>
        <div class="row">
            <div class="col-md-6">
                <?= Html::activeHiddenInput($model, 'galleryId') ?>
                <?= $form->field($model, 'title')->textInput(
                    ['maxlength' => 255, 'class'=>'form-control input-xlarge']
                ) ?>
                <?= $form->field($model, 'link')->textInput([
                    'maxlength' => 512,
                    'class' => 'form-control input-xlarge',
                    'style' => 'direction:ltr',
                ]) ?>
                <?= $form->field($model, 'description')->textarea(
                    ['rows' => 6, 'class'=>'form-control input-xlarge']
                ) ?>
                <?= $form->field($model, 'order')
                    ->dropDownList(
                        Utility::listNumbers(1, 20),
                        ['class' => 'form-control input-medium']
                    )
                ?>
            </div>
            <div class="col-md-6">
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'style' => 'width: 100%',
                            'class' => 'btn btn-success submit'
                        ]
                    )
                ?>
                <?php
                    echo SingleImageUpload::widget(
                        [
                            'model' => $model,
                            'group' => 'gallery_image',
                            'folderName' => 'gallery',
                            'label' => ''
                        ]
                    );
                ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php Panel::end();
